<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Models\Bill;
use App\Models\Student;
use App\Models\Semester;
use App\Models\Debt;
use App\Models\Payment;
use App\Models\BillData;
use App\Models\Career;
use App\Models\Term;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\PaymentPlan;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Type\Integer;

use function PHPUnit\Framework\assertIsArray;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationLabel = 'Facturas';
    protected static ?string $label = 'Factura'; // Cambia el label
    protected static ?string $pluralLabel = 'Factura'; // Cambia el plural label
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Estudiante')
                        ->schema([
                            Select::make('student_id')
                                ->label('Codigo del estudiante')
                                ->options(Student::all()->pluck('code', 'id'))
                                ->searchable(['code', 'email'])
                                ->required()
                                ->reactive()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (callable $set) => $set('semester_id', null))
                                ->afterStateUpdated(function (callable $set, callable $get) {
                                    $student_id = $get('student_id');
                                    $info = BillResource::getStudentInfo($student_id);

                                    $set('student_name', $info['names']);
                                    $set('student_career', $info['career']);
                                    $set('student_email', $info['email']);
                                }),
                            TextInput::make('student_name')
                            ->label('Nombre del estudiante')
                                ->label('Nombre del Estudiante')
                                ->readOnly()
                                ->reactive()
                                ->hidden(fn (callable $get) => !filled($get('student_id'))),
                            TextInput::make('student_career')
                            ->label('Carrera')
                                ->label('Estudiante de')
                                ->readOnly()
                                ->reactive()
                                ->hidden(fn (callable $get) => !filled($get('student_id'))),
                            TextInput::make('student_email')
                            ->label('email')
                                ->label('Email del estudiante')
                                ->reactive()
                                ->readOnly()
                                ->hidden(fn (callable $get) => !filled($get('student_id'))),
                        ]),
                    Step::make('Pension')
                        ->schema([
                            Select::make('semester_id')
                                ->label('Semestre')
                                ->searchable()
                                ->options(function (callable $get) {
                                    $student_id = $get('student_id');
                                    if ($student_id) {
                                        $paymentPlanId = Student::find($student_id)->PaymentPlan->id;
                                        return Semester::where('payment_plan_id', $paymentPlanId)->pluck('identifier', 'id');
                                    }
                                    return [];
                                })
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (callable $set) {
                                    $set('debt_ids', []);
                                    $set('type', 'fee');
                                }),
                            Select::make('type')
                            ->label('tipo')
                                ->options([
                                    'semestral' => 'Semestral',
                                    'fee' => 'Cuota',
                                ])
                                ->default('fee')
                                ->required()
                                ->reactive()
                                ->hidden(function (callable $get) {
                                    $semester_id = $get('semester_id');
                                    $student_id = $get('student_id');

                                    return BillResource::getPaymentHasBeenMade($student_id, $semester_id);
                                }),

                            CheckboxList::make('debt_ids')
                                ->label('Deudas')
                                ->options(function (callable $get) {
                                    $semesterId = $get('semester_id');

                                    if ($semesterId) {
                                        return Debt::where('semester_id', $semesterId)
                                            ->with('payments') // Eager load payments for efficient filtering
                                            ->whereDoesntHave('payments', function ($query) use ($get) {
                                                $studentId = $get('student_id'); // Access student_id from context

                                                if ($studentId) {
                                                    $query->where('student_id', $studentId); // Filter unpaid by this student
                                                }
                                            })
                                            ->pluck('info', 'id');
                                    }

                                    return [];
                                })
                                ->reactive()
                                ->required()
                                ->hidden(function (callable $get) {
                                    $is_full_payment = $get('type') !== 'fee';


                                    if ($is_full_payment) {
                                        $semester_id = $get('semester_id');
                                        $paymentsId = Debt::where('semester_id', $semester_id)
                                            ->with('payments')
                                            ->whereDoesntHave('payments', function ($query) use ($get) {
                                                $student_id = $get('student_id');

                                                if ($student_id) {
                                                    $query->where('student_id', $student_id);
                                                }
                                            })->pluck('id', 'id');
                                        $sum = 0;

                                        error_log(json_encode($paymentsId));

                                        foreach ($paymentsId as $debt_id) {
                                            $sum += Debt::find($debt_id)->total_cost;
                                        }
                                        $sum = $sum * 0.8;

                                        $var = fn (callable $set) => $set('semester_amount', $sum);

                                        error_log('I was here');
                                    }



                                    return $get('type') !== 'fee' && filled($get('semester_id'));
                                })
                                ->afterStateUpdated(fn (callable $set) => $set('amount', function (callable $get) {
                                    $paymentsId = $get('debt_ids');

                                    $sumAmount = 0;
                                    foreach ($paymentsId as $debtId) {
                                        $sumAmount += Debt::find($debtId)->total_cost;
                                    }



                                    return $sumAmount;
                                }))
                        ]),
                    Step::make('Pago')
                        ->schema([
                            TextInput::make('amount')
                            ->label('Monto')
                                ->required()
                                ->readOnly()
                                ->reactive()
                                ->numeric()
                                ->key('amount')
                                ->label('Monto a pagar'),
                            TextInput::make('NIT')
                                ->label('NIT')
                                ->required()
                                ->numeric(),
                            TextInput::make('social_reazon')
                                ->label('Razon social')
                                ->required(),
                            TextInput::make('bill_code')
                                ->label('Pago_id')
                                ->required()
                                ->hidden(),
                            TextInput::make('total_paid')
                                ->label('Pago en total')
                                ->numeric()
                                ->required()
                                ->gte('amount')
                                ->validationMessages(
                                    [
                                        'gte' => 'Se debe pagar un monto mayor al monto a pagar'
                                    ]
                                )
                                ->helperText('Incluye excedente que se devolvera como cambio'),
                            TextInput::make('change')
                                ->label('Cambio')
                                ->numeric()
                                ->hidden()
                                ->default(0)
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NIT')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_reazon')
                
                    ->searchable()
                    ->label('Razon social'),
                Tables\Columns\TextColumn::make('bill_code')
                    ->searchable()
                    ->label('Codigo de factura'),
                Tables\Columns\TextColumn::make('total_paid')
               
                    ->numeric()
                    ->sortable()
                    ->label(' Pagado en total'),
                Tables\Columns\TextColumn::make('change')
                    ->numeric()
                    ->sortable()
                    ->label('cambio'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('createPDF')
                    ->link()
                    ->action(function (Bill $record)
                    {
                        return redirect()->route('pdf.factura', $record->id);
                        }
                    )
                    ->label('Exportar factura a PDF')
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNameOfStudent($student_id): string
    {
        $return_val = '';

        $first_name = Person::find(Student::find($student_id)->person_id)->first_name;
        $last_name = Person::find(Student::find($student_id)->person_id)->last_name;

        $return_val = $first_name . ' ' . $last_name;

        return $return_val;
    }

    public static function getStudentInfo($student_id): array
    {
        $return_array[] = [];

        $return_array['names'] = BillResource::getNameOfStudent($student_id);
        $return_array['career'] = Career::find(PaymentPlan::find(Student::find($student_id)->payment_plan_id)->career_id)->name;
        $return_array['email'] = Person::find(Student::find($student_id)->person_id)->email;

        return $return_array;
    }

    public static function getPaymentHasBeenMade($student_id, $semester_id): bool
    {
        $r_val = Payment::whereHas('debt', function ($query) use ($semester_id) {
            $query->where('semester_id', $semester_id);
        })->where('student_id', $student_id)->exists();
        return $r_val;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBills::route('/'),
            'create' => Pages\CreateBill::route('/create'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
        ];
    }
}

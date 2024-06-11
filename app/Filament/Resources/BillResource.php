<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Models\Bill;
use App\Models\Student;
use App\Models\Semester;
use App\Models\Debt;
use App\Models\Payment;
use App\Models\BillData;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

use function PHPUnit\Framework\assertIsArray;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Estudiante')
                        ->schema([
                            Select::make('student_id')
                                ->label('Student')
                                ->options(Student::all()->pluck('code', 'id'))
                                ->searchable(['code', 'email'])
                                ->required()
                                ->afterStateUpdated(fn (callable $set) => $set('semester_id', null)),

                        ]),
                    Step::make('Pension')
                        ->schema([
                            Select::make('semester_id')
                                ->label('Semester')
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
                                ->afterStateUpdated(fn (callable $set) => $set('debt_ids', [])),
                            CheckboxList::make('debt_ids')
                                ->label('Debts')
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
                                            ->pluck('TotalCost', 'id');
                                    }

                                    return [];
                                })
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(fn (callable $set) => $set('amount', function (callable $get) {
                                    $paymentsId = $get('debt_ids');
                                    $sumAmount = 0;
                                    assertIsArray($paymentsId);
                                    foreach ($paymentsId as $debtId) {
                                        $sumAmount += Debt::find($debtId)->TotalCost;
                                    }

                                    return $sumAmount;
                                }))
                        ]),
                    Step::make('Pago')
                        ->schema([
                            TextInput::make('amount')
                                ->required()
                                ->readOnly()
                                ->reactive()
                                ->numeric(),
                            Select::make('payment_type')
                                ->required()
                                ->options([
                                    'semestral',
                                    'fee'
                                ]),
                            TextInput::make('NIT')
                                ->label('NIT')
                                ->required(),
                            TextInput::make('social_reazon')
                                ->label('Social Reazon')
                                ->required(),
                            TextInput::make('bill_code')
                                ->label('Bill Code')
                                ->required()
                                ->hidden(),
                            TextInput::make('total_paid')
                                ->label('Total Paid')
                                ->numeric()
                                ->required()
                                ->gte('amount'),
                            TextInput::make('change')
                                ->label('Change')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('bill_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('change')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBills::route('/'),
            'create' => Pages\CreateBill::route('/create'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
        ];
    }
}

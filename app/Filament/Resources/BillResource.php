<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Filament\Resources\BillResource\RelationManagers;
use App\Models\Bill;
use App\Models\Management;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function PHPSTORM_META\map;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationNavigation = 'heroicon-o-clipboard-document-check';

    protected static ?string $label = 'Recurso factura'; 

    protected static ?string $pluralLabel = 'Recurso factura'; 


    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Wizard::make([
                Step::make('Student')
                    ->schema([
                        Select::make('student_id')
                            ->options(Student::all()->pluck('code', 'id'))
                            ->searchable()
                            ->required()
                            ->label('Student Code'),
                    ]),
                    Step::make('Plan')
                    ->schema([
                        Select::make('plan_id')
                            ->label('Payment Plan')
                            ->options(function ($get) {
                                $studentId = $get('student_id');
                                return $studentId ? \App\Models\Management::whereHas('students', function ($query) use ($studentId) {
                                    $query->where('students.id', $studentId);
                                })->pluck('management', 'id') : [];
                            })
                            ->required(),
                    ]),
                Step::make('Payment')
                    ->schema([
                        TextInput::make('paid_ammount')->required(),
                        DatePicker::make('payment_date')->required(),
                        TextInput::make('nit')->required(),
                        TextInput::make('social_reason')->required(),
                        Select::make('type_of_payment')
                            ->options([
                                'effective' => 'Effective',
                                'transfer' => 'Transfer',
                            ])
                            ->required(),
                    ]),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
       
        return $table
            ->columns([
                TextColumn::make('paid_ammount'),
                TextColumn::make('student.code'),
                TextColumn::make('plan.name'),
            ])
            ->filters([]);
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

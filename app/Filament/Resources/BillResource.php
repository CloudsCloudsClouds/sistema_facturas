<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Models\Bill;
use App\Models\BillData;
use App\Models\Debt;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                                ->relationship('student', 'code')
                                ->searchable()
                                ->required(),
                        ]),
                    Step::make('Pension')
                        ->schema([
                            Select::make('semester_id')
                                ->label('Semester')
                                ->relationship('semester', 'id')
                                ->searchable()
                                ->required(),
                            Repeater::make('debts')
                                ->label('Debts')
                                ->schema([
                                    Select::make('debt_id')
                                        ->label('Debt')
                                        ->options(Debt::all()->pluck('TotalCost', 'id'))
                                        ->searchable()
                                        ->required(),
                                ])
                        ]),
                    Step::make('Pago')
                        ->schema([
                            Repeater::make('payments')
                                ->label('Payments')
                                ->schema([
                                    TextInput::make('amount')
                                        ->label('Amount')
                                        ->numeric()
                                        ->required(),
                                ]),
                            TextInput::make('NIT')
                                ->label('NIT')
                                ->required(),
                            TextInput::make('social_reazon')
                                ->label('Social Reazon')
                                ->required(),
                            TextInput::make('bill_code')
                                ->label('Bill Code')
                                ->required(),
                            TextInput::make('total_paid')
                                ->label('Total Paid')
                                ->numeric()
                                ->required(),
                            TextInput::make('change')
                                ->label('Change')
                                ->numeric()
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

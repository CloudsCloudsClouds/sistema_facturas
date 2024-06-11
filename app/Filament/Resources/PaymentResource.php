<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationLabel = 'Pagos';
    protected static ?string $label = 'Pagos'; // Cambia el label
    protected static ?string $pluralLabel = 'Pagos'; // Cambia el plural label
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                ->label('Tipo')
                    ->required(),
                Forms\Components\TextInput::make('ammount')
                ->label('Monto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('debt_id')
                ->label('Deuda')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('student_id')
                ->label('Estidiante')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('date_of_payment')
                ->label('Fecha de pago')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                ->label('Tipo'),
                Tables\Columns\TextColumn::make('ammount')
                ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('debt.description')
                ->label('Descripcion de deuda')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.code')
                ->label('Estudiante')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_payment')
                ->label('Fecha de pago')
                    ->dateTime()
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}

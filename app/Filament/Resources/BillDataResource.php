<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillDataResource\Pages;
use App\Filament\Resources\BillDataResource\RelationManagers;
use App\Models\Bill;
use App\Models\BillData;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillDataResource extends Resource
{
    protected static ?string $model = BillData::class;

    protected static ?string $navigationLabel = 'Datos de la Factura';
    protected static ?string $label = 'Datos de Factura'; // Cambia el label
    protected static ?string $pluralLabel = 'Datos de Factura'; // Cambia el plural lab
        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bill_id')
                    ->required()
                    ->options(Bill::all()->pluck('code', 'id'))
                    ->label('Factura')
                    ->searchable(),
                Forms\Components\Select::make('payment_id')
                    ->required()
                    ->options(Payment::all()->pluck('id', 'id'))
                    ->searchable()
                    ->label('Pago'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bill.NIT')
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
            'index' => Pages\ListBillData::route('/'),
            'create' => Pages\CreateBillData::route('/create'),
            'edit' => Pages\EditBillData::route('/{record}/edit'),
        ];
    }
}

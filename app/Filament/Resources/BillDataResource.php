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

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
<<<<<<< HEAD
    protected static ?string $navigationLabel = 'Dato factura';
=======
    protected static ?string $navigationLabel = 'Datos de Factura';
>>>>>>> 149a63a3885393b77214f3f000c231cdc5d1286f

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('payment_id')
                ->label('id de pago')
                    ->required()
                    ->options(Payment::all()->pluck('id'. 'id'))
                    ->searchable(),
                Forms\Components\Select::make('bill_data')
                ->label('Datos de Factura')
                    ->required()
                    ->options(Bill::all()->pluck('bill_code', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_id')
                ->label('Id de pago')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bill_data')
                ->label('Datos de factura')
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

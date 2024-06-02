<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Filament\Resources\BillResource\RelationManagers;
use App\Models\Bill;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationNavigation = 'heroicon-o-clipboard-document-check';

    protected static ?string $label = 'Recurso factura'; // Cambia el label

    protected static ?string $pluralLabel = 'Recurso factura'; // Cambia el plural label





    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Seleccionar estudiante')
                        ->schema([

                        ]),
                    Wizard\Step::make('Seleccionar pago')
                        ->schema([

                        ]),
                    Wizard\Step::make('Seleccionar monto')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('paid_ammount')
                ->label('Monto de pago')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('change')
                ->label('Cambio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nit')
                ->label('NIT')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_reason')
                ->label('Razon Social')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bill_code')
                ->label('Codigo de Factura')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_of_payment')->label('Forma de Pago'),
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

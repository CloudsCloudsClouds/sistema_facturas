<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentPlanDataResource\Pages;
use App\Filament\Resources\PaymentPlanDataResource\RelationManagers;
use App\Models\PaymentPlan;
use App\Models\PaymentPlanData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentPlanDataResource extends Resource
{
    protected static ?string $model = PaymentPlanData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('payment_plan_id')
                    ->required()
                    ->options(PaymentPlan::all()->pluck('id', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('administration')
                    ->required()
                    ->maxLength(255)
                    ->regex('^\d{2}/[12]$'),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_plan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('administration')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListPaymentPlanData::route('/'),
            'create' => Pages\CreatePaymentPlanData::route('/create'),
            'edit' => Pages\EditPaymentPlanData::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentPlanResource\Pages;
use App\Filament\Resources\PaymentPlanResource\RelationManagers;
use App\Models\PaymentPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentPlanResource extends Resource
{
    protected static ?string $model = PaymentPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tuition')
                ->label('Matricula')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('credit')
                ->label('Credito')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tuition')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('credit')
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
            'index' => Pages\ListPaymentPlans::route('/'),
            'create' => Pages\CreatePaymentPlan::route('/create'),
            'edit' => Pages\EditPaymentPlan::route('/{record}/edit'),
        ];
    }
}

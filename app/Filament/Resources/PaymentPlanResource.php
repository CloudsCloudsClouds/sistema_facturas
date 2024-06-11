<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentPlanResource\Pages;
use App\Filament\Resources\PaymentPlanResource\RelationManagers;
use App\Models\Career;
use App\Models\PaymentPlan;
use App\Models\Term;
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
protected static ?string $navigationLabel = 'Planes de Pago';
    protected static ?string $label = 'Planes de Pago'; // Cambia el label
    protected static ?string $pluralLabel = 'Planes de Pago'; // Cambia el plural label
        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('career_id')
                    ->required()
                    ->options(Career::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('term_id')
                    ->required()
                    ->options(Term::all()->pluck('period', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('tuition')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('identifier')
                    ->label('Identifier')
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('career.name')
                    ->numeric()
                    ->sortable()
                    ->label('Carrera'),
                Tables\Columns\TextColumn::make('term.period')
                    ->numeric()
                    ->sortable()
                    ->label('Gestion'),
                Tables\Columns\TextColumn::make('tuition')
                    ->numeric()
                    ->sortable()
                    ->label('Matricula'),
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

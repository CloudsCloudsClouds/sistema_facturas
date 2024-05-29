<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagementResource\Pages;
use App\Filament\Resources\ManagementResource\RelationManagers;
use App\Models\Career;
use App\Models\Management;
use App\Models\PaymentPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManagementResource extends Resource
{
    protected static ?string $model = Management::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';
    protected static ?string $navigationLabel = 'Administracion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('career_id')
                ->label('Carrea id')
                    ->required()
                    ->options(Career::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('payment_plan_id')
                ->label('Plan de Pago')
                    ->required()
                    ->options(PaymentPlan::all()->pluck('tuition', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('management')
                ->label('Identificador')
                    ->required()
                    ->maxLength(255)
                    ->regex('^\d{2}/[12]$^'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('career_id.name')
                ->label('Carrea e ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_plan_id.name')
                ->label('Plan de pago e ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('management')
                ->label('Identificador')
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
            'index' => Pages\ListManagement::route('/'),
            'create' => Pages\CreateManagement::route('/create'),
            'edit' => Pages\EditManagement::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TermResource\Pages;
use App\Filament\Resources\TermResource\RelationManagers;
use App\Models\Term;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TermResource extends Resource
{
    protected static ?string $model = Term::class;

        protected static ?string $navigationLabel = 'Gestion';
    protected static ?string $label = 'Gestion';
    protected static ?string $pluralLabel = 'Gestiones';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('period')
                ->label('Gestion')
                    ->required()
                    ->regex('/^[12]\/[0-9]{2}$/'),
                Forms\Components\DatePicker::make('beginning')
                ->label('Comienzo')
                    ->required(),
                Forms\Components\DatePicker::make('end')
                ->label('Fin')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('period')
                    ->searchable()
                    ->label('periodo'),
                Tables\Columns\TextColumn::make('beginning')
                    ->date()
                    ->sortable()
                    ->label('inicio'),
                Tables\Columns\TextColumn::make('end')
                    ->date()
                    ->sortable()
                    ->label('fin'),
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
            'index' => Pages\ListTerms::route('/'),
            'create' => Pages\CreateTerm::route('/create'),
            'edit' => Pages\EditTerm::route('/{record}/edit'),
        ];
    }
}

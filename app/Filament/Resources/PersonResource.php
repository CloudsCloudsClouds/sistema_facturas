<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonResource\Pages;
use App\Filament\Resources\PersonResource\RelationManagers;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;
    protected static ?string $navigationLabel = 'Personas';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('second_name')
                ->label('segundo nombre')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('middle_name')
                ->label('Apellido paterno')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                ->label('Apellido materno')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('number')
                ->label('Numero')
                    ->required()
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('direction')
                ->label('Direccion')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ci')
                ->label('Numero de carnet')
                    ->required()
                    ->maxLength(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Primer Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('second_name')
                    ->label('Segundo Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->label('Apellido Paterno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido Materno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->label('Email')
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}

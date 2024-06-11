<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DebtResource\Pages;
use App\Filament\Resources\DebtResource\RelationManagers;
use App\Models\Debt;
use App\Models\Semester;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function PHPUnit\Framework\isTrue;

class DebtResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Deudas';
    protected static ?string $label = 'Deudas'; // Cambia el label
    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('semester_id')
                ->label('Semestre_id')
                    ->required()
                    ->options(Semester::all()->pluck('identifier', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('total_cost')
                ->label('Costo toral')
                    ->required()
                    ->numeric()
                    ->helperText('Este es el costo TOTAL del semestre, no el costo individual de cada cuota ¡Cuidado!')
                    ->prefix('Bs.'),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                        'Carrera' => 'Carrera',
                        'Curso' => 'Curso'
                    ])
                    ->default('Carrera')
                    ->selectablePlaceholder(false)
                    ->afterStateUpdated(
                        fn ($state, callable $set) =>
                        $set('enable_identifier', $state === 'Curso')
                    )
                    ->live(onBlur: true)
                    ->reactive(),
                Forms\Components\TextInput::make('description')
                ->label('Descripcion')
                    ->reactive()
                    ->live()
                    ->disabled(fn (callable $get) => $get('enable_identifier') !== true)
                    ->readOnly(fn (callable $get) => $get('enable_identifier') !== true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('semester.identifier')
                    ->numeric()
                    ->sortable()
                    ->label('semestre'),
                Tables\Columns\TextColumn::make('total_cost')
                    ->numeric()
                    ->sortable()
                    ->label('costo'),
                Tables\Columns\TextColumn::make('type')
                ->label('Tipo'),
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
            'index' => Pages\ListDebts::route('/'),
            'create' => Pages\CreateDebt::route('/create'),
            'edit' => Pages\EditDebt::route('/{record}/edit'),
        ];
    }
}

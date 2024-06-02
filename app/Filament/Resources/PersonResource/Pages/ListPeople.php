<?php

namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use App\Models\Person;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
            Action::make('createPDF')

                ->label('Reporte de personas')
                ->color('warning')
                //->requiresConfirmation()
                ->url(
                    fn (): string => route('pdf.factura', ['user' => Auth::user()]),
                    shouldOpenInNewTab: true
                )
        ];
    }
}

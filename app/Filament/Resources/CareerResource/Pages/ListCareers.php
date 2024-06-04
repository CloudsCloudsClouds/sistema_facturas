<?php

namespace App\Filament\Resources\CareerResource\Pages;

use App\Filament\Resources\CareerResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListCareers extends ListRecords
{
    protected static string $resource = CareerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('createPDF')
            ->label('Reporte de Carreras')
            ->color('warning')
            //->requiresConfirmation()
            ->url(
                fn (): string => route('pdf.reporteCarreras'),
                shouldOpenInNewTab: true
            )
        ];
    }
}

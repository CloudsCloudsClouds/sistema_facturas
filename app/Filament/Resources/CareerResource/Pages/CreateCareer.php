<?php

namespace App\Filament\Resources\CareerResource\Pages;

use App\Filament\Resources\CareerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCareer extends CreateRecord
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

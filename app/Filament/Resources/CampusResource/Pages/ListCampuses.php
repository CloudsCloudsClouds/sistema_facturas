<?php

namespace App\Filament\Resources\CampusResource\Pages;

use App\Filament\Resources\CampusResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListCampuses extends ListRecords
{
    protected static string $resource = CampusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),


            Action::make('createPDF')
            ->label('Reporte de sucursales')
            ->color('warning')
            //->requiresConfirmation()
            ->url(
                fn (): string => route('pdf.reporteSucursales'),
                shouldOpenInNewTab: true
            )
        ];
    }
}

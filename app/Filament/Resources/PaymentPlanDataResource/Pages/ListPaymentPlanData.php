<?php

namespace App\Filament\Resources\PaymentPlanDataResource\Pages;

use App\Filament\Resources\PaymentPlanDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentPlanData extends ListRecords
{
    protected static string $resource = PaymentPlanDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

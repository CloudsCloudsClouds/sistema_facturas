<?php

namespace App\Filament\Resources\PaymentPlanDataResource\Pages;

use App\Filament\Resources\PaymentPlanDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentPlanData extends EditRecord
{
    protected static string $resource = PaymentPlanDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\BillDataResource\Pages;

use App\Filament\Resources\BillDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBillData extends EditRecord
{
    protected static string $resource = BillDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

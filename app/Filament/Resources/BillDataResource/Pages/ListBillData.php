<?php

namespace App\Filament\Resources\BillDataResource\Pages;

use App\Filament\Resources\BillDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBillData extends ListRecords
{
    protected static string $resource = BillDataResource::class;

    public function canCreate()
    {
        return false;
    }

    public function canEdit()
    {
        return false;
    }
}

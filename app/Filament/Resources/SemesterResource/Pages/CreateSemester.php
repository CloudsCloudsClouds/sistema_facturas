<?php

namespace App\Filament\Resources\SemesterResource\Pages;

use App\Filament\Resources\SemesterResource;
use App\Models\PaymentPlan;
use App\Models\Semester;
use App\Models\Term;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateSemester extends CreateRecord
{
    protected static string $resource = SemesterResource::class;

    protected function handleRecordCreation(array $data): Semester
    {
        $identifier = Term::find($data['payment_plan_id']);

        $data['identifier'] = $identifier->identifier;

        return Semester::create($data);
    }
}

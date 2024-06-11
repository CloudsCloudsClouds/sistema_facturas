<?php

namespace App\Filament\Resources\SemesterResource\Pages;

use App\Filament\Resources\SemesterResource;
use App\Models\Career;
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
        $identifier_period = Term::find($data['term_id'])->period;

        $identifier_career = Career::find(PaymentPlan::find($data['payment_plan_id'])->career_id)->name;

        $data['identifier'] = $identifier_career . ' ' . $identifier_period;

        return Semester::create($data);
    }
}

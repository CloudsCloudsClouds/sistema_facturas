<?php

namespace App\Filament\Resources\PaymentPlanResource\Pages;

use App\Filament\Resources\PaymentPlanResource;
use App\Models\Career;
use App\Models\PaymentPlan;
use App\Models\Term;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePaymentPlan extends CreateRecord
{
    protected static string $resource = PaymentPlanResource::class;

    protected function handleRecordCreation(array $data): PaymentPlan
    {
        // Get career and term data
        $career = Career::find($data['career_id']);
        $term = Term::find($data['term_id']);

        // Set identifier
        $data['identifier'] = $career->name . ' ' . $term->period;

        // Create the PaymentPlan
        return PaymentPlan::create($data);
    }
}

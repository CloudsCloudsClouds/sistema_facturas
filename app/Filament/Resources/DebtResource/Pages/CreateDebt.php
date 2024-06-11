<?php

namespace App\Filament\Resources\DebtResource\Pages;

use App\Filament\Resources\DebtResource;
use App\Models\Debt;
use App\Models\PaymentPlan;
use App\Models\Semester;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNan;

class CreateDebt extends CreateRecord
{
    protected static string $resource = DebtResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $models = [];

        if (!key_exists('description', $data))
        {
            $data["description"] = '';
        }

        if (isNan($data['description']))
        {
            $better_id = PaymentPlan::find(Semester::find($data['semester_id'])->payment_plan_id)->identifier;

            $data['description'] = $better_id . ' cuota ';
        }

        for ($i=1; $i <= 5; $i++) {
            $models[] = Debt::create([
                'semester_id' => $data['semester_id'],
                'total_cost' => $data['total_cost'] / 5,
                'type' => $data['type'],
                'description' => $data['description'] . $i,
                'share' => $i,
            ]);
        }

        return $models[0];
    }
}

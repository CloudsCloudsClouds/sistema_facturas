<?php

namespace App\Filament\Resources\BillResource\Pages;

use App\Filament\Resources\BillResource;
use App\Models\Bill;
use App\Models\BillData;
use App\Models\Payment;
use App\Models\Debt;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateBill extends CreateRecord
{
    protected static string $resource = BillResource::class;

    protected function handleRecordCreation(array $data): Bill
    {
        return DB::transaction(function () use ($data) {
            // Create the Bill
            if (!key_exists('type', $data)) {
                $data['type'] = 'fee';
            }
            $bill = Bill::create([
                'NIT' => $data['NIT'],
                'social_reazon' => $data['social_reazon'],
                'bill_code' => fake()->randomNumber(9, true),
                'total_paid' => $data['total_paid'],
                'change' => $data['total_paid'] - $data['amount'],
            ]);

            // Create Payments
            foreach ($data['debt_ids'] as $debt_ids) {
                $payment = Payment::create([
                    'type' => $data['type'],
                    'ammount' => Debt::find($debt_ids)->total_cost,
                    'debt_id' => $debt_ids,
                    'student_id' => $data['student_id'],
                    'date_of_payment' => now(),
                ]);

                // Create Bill Data
                BillData::create([
                    'bill_id' => $bill->id,
                    'payment_id' => $payment->id,
                ]);
            }
            return $bill;
        });
    }
}

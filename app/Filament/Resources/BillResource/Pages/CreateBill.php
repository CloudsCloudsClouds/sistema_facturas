<?php

namespace App\Filament\Resources\BillResource\Pages;

use App\Filament\Resources\BillResource;
use App\Models\Bill;
use App\Models\BillData;
use App\Models\Payment;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateBill extends CreateRecord
{
    protected static string $resource = BillResource::class;

    protected function handleRecordCreation(array $data): Bill
    {
        return DB::transaction(function () use ($data) {
            // Create the Bill
            $data['date_of_payment'] = now();
            $bill = Bill::create([
                'NIT' => $data['NIT'],
                'social_reazon' => $data['social_reazon'],
                'bill_code' => $data['bill_code'],
                'total_paid' => $data['total_paid'],
                'change' => $data['change'],
            ]);

            // Create Payments
            foreach ($data['payments'] as $paymentData) {
                $payment = Payment::create([
                    'type' => 'semestral', // or 'fee', depending on your logic
                    'amount' => $paymentData['amount'],
                    'debt_id' => $paymentData['debt_id'], // you might need to adapt this part
                    'student_id' => $data['student_id'],
                    'date_of_payment' => $paymentData['date_of_payment'],
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

<?php
namespace App\Filament\Resources\BillResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BillResource;
use App\Models\Bill;
use App\Models\Payment;

class CreateBill extends CreateRecord
{
    protected static string $resource = BillResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Extract the necessary data
        $studentId = $data['student_id'];
        
        $planId = $data['plan_id'];
        $paymentData = [
            'amount' => $data['paid_ammount'],
            'payment_date' => $data['payment_date'],
            'type_of_payment' => $data['type_of_payment'],
        ];

        // Unset payment-specific fields from bill data
        unset($data['paid_ammount'], $data['payment_date'], $data['type_of_payment']);

        // Create the bill
        $bill = Bill::create([
            'paid_ammount' => $paymentData['amount'],
            'nit' => $data['nit'],
            'social_reason' => $data['social_reason'],
            'bill_code' => fake()->randomNumber(9, true),
            'type_of_payment' => $paymentData['type_of_payment'],
        ]);

        // Create the payment and associate it with the bill
        Payment::create([
            'student_id' => $studentId,
            'payment_plan_data_id' => $planId, 
            'ammount_payed' => $paymentData['amount'],
            'date' => $paymentData['payment_date'],
        ]);

        unset($data['student_id']);
        unset($data['plan_id']);


        return $data;
    }
}

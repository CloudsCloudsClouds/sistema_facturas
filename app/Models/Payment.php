<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    public function Student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function BillData(): BelongsTo
    {
        return $this->belongsTo(BillData::class);
    }

    public function PaymentPlanData(): HasOne
    {
        return $this->hasOne(PaymentPlanData::class);
    }
}
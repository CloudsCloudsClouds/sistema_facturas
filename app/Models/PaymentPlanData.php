<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentPlanData extends Model
{
    use HasFactory;

    public function PaymentPlan(): HasOne
    {
        return $this->hasOne(PaymentPlan::class);
    }

    public function Payment(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }
}

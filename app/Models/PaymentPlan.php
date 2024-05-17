<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentPlan extends Model
{
    use HasFactory;

    public function PaymentPlanDate(): BelongsToMany
    {
        return $this->belongsToMany(PaymentPlanData::class);
    }

    public function Management(): BelongsTo
    {
        return $this->belongsTo(Management::class);
    }
}

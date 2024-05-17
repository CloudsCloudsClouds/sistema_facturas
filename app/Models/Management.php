<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Management extends Model
{
    use HasFactory;

    public function Career(): HasOne
    {
        return $this->hasOne(Career::class);
    }

    public function Students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function PaymentPlan(): HasMany
    {
        return $this->hasMany(PaymentPlan::class);
    }
}

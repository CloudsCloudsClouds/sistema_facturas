<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    public function Person(): HasOne
    {
        return $this->hasOne(Person::class);
    }

    public function Managements(): HasMany
    {
        return $this->hasMany(Management::class);
    }

    public function Payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }
}

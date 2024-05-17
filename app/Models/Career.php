<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Career extends Model
{
    use HasFactory;

    public function Campus(): HasOne
    {
        return $this->hasOne(Campus::class);
    }

    public function Managements(): BelongsToMany
    {
        return $this->belongsToMany(Management::class);
    }
}
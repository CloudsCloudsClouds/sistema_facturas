<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campus extends Model
{
    use HasFactory;

    public function Careers(): BelongsToMany
    {
        return $this->belongsToMany(Career::class);
    }
}

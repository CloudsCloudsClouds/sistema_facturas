<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BillData extends Model
{
    use HasFactory;

    public function Bill(): HasOne
    {
        return $this->hasOne(Bill::class);
    }

    public function Payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}

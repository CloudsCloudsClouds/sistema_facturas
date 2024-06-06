<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function billData()
    {
        return $this->hasMany(BillData::class);
    }
}

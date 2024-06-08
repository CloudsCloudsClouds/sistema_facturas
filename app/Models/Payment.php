<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    public static function boot()
    {
        parent::boot();

        static::creating(function ($paymentPlan) {
            $career = Career::find($paymentPlan->career_id);
            $term = Term::find($paymentPlan->term_id);

            if ($career && $term) {
                $paymentPlan->identifier = $career->name + ' ' + $term->period;
            }
        });
    }

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

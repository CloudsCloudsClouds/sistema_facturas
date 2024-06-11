<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    public function paymentPlans()
    {
        return $this->hasMany(PaymentPlan::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}

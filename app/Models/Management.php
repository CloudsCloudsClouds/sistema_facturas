<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $fillable = ['career_id', 'payment_plan_id', 'management'];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function paymentPlan()
    {
        return $this->belongsTo(PaymentPlan::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

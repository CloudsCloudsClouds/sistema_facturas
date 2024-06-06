<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'management_id', 'email', 'code'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function management()
    {
        return $this->belongsTo(Management::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

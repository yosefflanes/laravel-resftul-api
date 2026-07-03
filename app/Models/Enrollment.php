<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id'
    ];

    // satu enrollment hanya milik satu user(student)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // setiap enrollment dimiliki oleh atau merujuk pada satu course saja
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

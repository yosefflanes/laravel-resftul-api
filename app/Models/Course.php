<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Relasi: belongsTo CourseCategory, belongsTo User (Instructor)

    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'description',
        'rating',
        'thumbnail',
        'level',
        'duration',
        'status',
        'enrolled_count'
    ];

    protected $hidden = [
        'instructor_id',
        'category_id',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['rating_class'];

    // satu kursus hanya memiliki satu coursecategory
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    //satu kursus hanya dibuat oleh satu user('instructor_id)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // satu kursus dapat memiliki banyak enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function getRatingClassAttribute()
    {
        if ($this->rating >= 8.5) {
            return 'Top rated';
        }
        if ($this->rating >= 7.0) {
            return 'Recommended';
        }
        return 'Regular';
    }
}

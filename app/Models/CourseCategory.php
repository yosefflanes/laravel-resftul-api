<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{

    use HasFactory;

    // Relasi: hasMany Course

    protected $fillable = [
        'name',
        'description',
        'icon'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    // satu CourseCategory dapat memiliki banyak course
    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}

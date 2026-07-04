<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::firstOrCreate([
            'instructor_id'  => 1,
            'category_id'    => 1,
            'title'          => 'Full-Stack Laravel React',
            'description'    => 'Build modern web apps with Laravel and React',
            'rating'         => 8.9,
            'thumbnail'      => 'course.jpg',
            'level'          => 'intermediate',
            'duration'       => 1200,
            'status'         => 'published',
            'enrolled_count' => 156,
        ]);

        Course::firstOrCreate([
            'instructor_id'  => 1,
            'category_id'    => 1,
            'title'          => 'Belajar Laravel untuk Pemula',
            'description'    => 'Panduan lengkap belajar Laravel dari nol hingga mahir',
            'rating'         => 9.0,
            'thumbnail'      => 'laravel-beginner.jpg',
            'level'          => 'beginner',
            'duration'       => 800,
            'status'         => 'published',
            'enrolled_count' => 320,
        ]);

        Course::firstOrCreate([
            'instructor_id'  => 2,
            'category_id'    => 2,
            'title'          => 'Flutter Mobile Development',
            'description'    => 'Membuat aplikasi mobile cross-platform dengan Flutter',
            'rating'         => 8.5,
            'thumbnail'      => 'flutter.jpg',
            'level'          => 'intermediate',
            'duration'       => 1000,
            'status'         => 'published',
            'enrolled_count' => 98,
        ]);

        Course::firstOrCreate([
            'instructor_id'  => 2,
            'category_id'    => 3,
            'title'          => 'Python untuk Data Science',
            'description'    => 'Analisis data menggunakan Python, Pandas, dan Matplotlib',
            'rating'         => 7.8,
            'thumbnail'      => 'data-science.jpg',
            'level'          => 'beginner',
            'duration'       => 900,
            'status'         => 'published',
            'enrolled_count' => 210,
        ]);

        Course::firstOrCreate([
            'instructor_id'  => 1,
            'category_id'    => 4,
            'title'          => 'UI/UX Design dengan Figma',
            'description'    => 'Belajar desain antarmuka profesional menggunakan Figma',
            'rating'         => 6.5,
            'thumbnail'      => 'figma.jpg',
            'level'          => 'beginner',
            'duration'       => 600,
            'status'         => 'draft',
            'enrolled_count' => 0,
        ]);
    }
}

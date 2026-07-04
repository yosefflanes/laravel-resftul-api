<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseCategory;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseCategory::firstOrCreate([
            'name'        => 'Web Development',
            'description' => 'Kursus seputar pengembangan website frontend dan backend',
            'icon'        => 'web.png',
        ]);

        CourseCategory::firstOrCreate([
            'name'        => 'Mobile Development',
            'description' => 'Kursus seputar pengembangan aplikasi mobile Android dan iOS',
            'icon'        => 'mobile.png',
        ]);

        CourseCategory::firstOrCreate([
            'name'        => 'Data Science',
            'description' => 'Kursus seputar analisis data dan machine learning',
            'icon'        => 'data.png',
        ]);

        CourseCategory::firstOrCreate([
            'name'        => 'UI/UX Design',
            'description' => 'Kursus seputar desain antarmuka dan pengalaman pengguna',
            'icon'        => 'design.png',
        ]);
    }
}

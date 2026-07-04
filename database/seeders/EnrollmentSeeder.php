<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enrollment::firstOrCreate([
            'student_id' => 3,
            'course_id'  => 1,
        ]);

        Enrollment::firstOrCreate([
            'student_id' => 3,
            'course_id'  => 2,
        ]);

        Enrollment::firstOrCreate([
            'student_id' => 4,
            'course_id'  => 1,
        ]);

        Enrollment::firstOrCreate([
            'student_id' => 4,
            'course_id'  => 3,
        ]);
    }
}

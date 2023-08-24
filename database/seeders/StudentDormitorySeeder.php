<?php

namespace Database\Seeders;

use App\Models\StudentDormitory;
use Illuminate\Database\Seeder;

class StudentDormitorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentDormitory::factory()->create();
    }
}

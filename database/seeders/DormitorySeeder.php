<?php

namespace Database\Seeders;

use App\Models\Dormitory;
use Illuminate\Database\Seeder;

class DormitorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dormitory::factory()->create();
    }
}

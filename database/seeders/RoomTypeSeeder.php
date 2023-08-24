<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Database\Factories\RoomTypeFactory;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::factory()->create();
    }
}

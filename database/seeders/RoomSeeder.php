<?php

namespace Database\Seeders;

use App\Models\Room;
use Database\Factories\RoomFactory;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::factory()->create();
    }
}

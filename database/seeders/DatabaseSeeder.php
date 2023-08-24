<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(DormitorySeeder::class);
        $this->call(RoomTypeSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(StudentDormitorySeeder::class);
    }
}

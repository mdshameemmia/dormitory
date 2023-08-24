<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "room_number" => 101,
            "number_of_bed" => 4,
            "number_of_booked" => 0,
            "description" => 'Test Description',
            "status" => 'Vacant',
            "dormitory_id" => 1,
            "room_type_id" => 1
        ];
    }
}

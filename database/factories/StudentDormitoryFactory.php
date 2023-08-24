<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentDormitoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "student_name"=>"MD. SHAMEEM MIA",
            "status"=>1,
            "dormitory_id"=>1,
            "room_id"=>1
        ];
    }
}

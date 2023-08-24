<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DormitoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
                "name" => 'Dormitory Test',
                "type" => 'boys',
                "status" => 'Vacant',
                "address" => "Khilkhet, Dhaka"
        
        ];
    }
}

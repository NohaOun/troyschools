<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;
use App\Models\Student;

class StudentFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
         
        $schools = School::pluck('id')->toArray();
       
        return [
            'name' => $this->faker->name(),
            'school_id' => $this->faker->randomElement($schools),
          
            
        ];
    }

}

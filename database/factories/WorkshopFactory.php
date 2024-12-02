<?php

namespace Database\Factories;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkshopFactory extends Factory
{
    protected $model = Workshop::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'duration' => $this->faker->numberBetween(60, 180),
            'price' => $this->faker->numberBetween(10000, 50000),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeBetween('+1 week', '+6 months'),
            'status' => $this->faker->randomElement(['Upcoming', 'Completed']),
            'vc_link' => $this->faker->url,
            'objectivs' => json_encode([
                'Understanding REST APIs',
                'Building Frontend with React',
                'Deploying Applications with Docker',
            ]),
            'instructor_id' => 1,
        ];
    }
}

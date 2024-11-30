<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Workshop;
use App\Models\Topic;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = User::factory()->count(5)->create(['is_instructor' => true]);

        $topics = Topic::factory()->count(10)->create();

        $workshops = Workshop::factory()
            ->count(10)
            ->create()
            ->each(function ($workshop) use ($instructors, $topics) {
                $workshop->instructor_id = $instructors->random()->id;
                $workshop->save();

                $workshop->topics()->attach(
                    $topics->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}

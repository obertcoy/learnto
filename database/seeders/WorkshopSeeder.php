<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Review;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Workshop;
use App\Models\Topic;
use Illuminate\Support\Facades\Hash;

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

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@learnto.com',
            'password' => Hash::make('test12345'),
            'biography' => "Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! ",
            'is_instructor' => 1
        ]);

        $ongoingWorkshop = Workshop::factory()->create([
            'instructor_id' => $testUser->id,
            'status' => 'Upcoming',
            'name' => 'Upcoming Workshop',
            'description' => 'This is a description of the ongoing workshop.',
        ]);

        $completedWorkshop = Workshop::factory()->create([
            'instructor_id' => $testUser->id,
            'status' => 'Completed',
            'name' => 'Completed Workshop',
            'description' => 'This is a description of the completed workshop.',
        ]);

        $ongoingWorkshop->topics()->attach(
            $topics->random(rand(1, 3))->pluck('id')->toArray()
        );

        $completedWorkshop->topics()->attach(
            $topics->random(rand(1, 3))->pluck('id')->toArray()
        );

        $participants = User::factory()->count(2)->create();

        $test2User = User::factory()->create([
            'name' => 'Test 2 User',
            'email' => 'test2@learnto.com',
            'password' => Hash::make('test12345'),
            'biography' => "Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! Test Account! ",
            'is_instructor' => 0
        ]);

        foreach ([$ongoingWorkshop, $completedWorkshop] as $workshop) {
            $workshop->users()->attach($participants->pluck('id')->toArray());
            $workshop->users()->attach($test2User->id);
        }

        foreach ($completedWorkshop->users as $user) {
            Rating::create([
                'user_id' => $user->id,
                'workshop_id' => $completedWorkshop->id,
                'rating' => rand(3, 5),
            ]);

            Review::create([
                'user_id' => $user->id,
                'workshop_id' => $completedWorkshop->id,
                'content' => 'Great workshop! Learned a lot.',
            ]);
        }
    }
}

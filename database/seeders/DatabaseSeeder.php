<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use App\Models\Workshop;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@learnto.com',
            'password' => Hash::make('admin12345'),
            'is_admin' => 1,
        ]);

        $this->call([WorkshopSeeder::class]);

       
    }
}

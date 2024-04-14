<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);

        /**
         * ROLE SEEDER
         */

        Role::factory()->create([
            'name' => 'SuperAdmin',
        ]);

        Role::factory()->create([
            'name' => 'Admin',
        ]);

        Role::factory()->create([
            'name' => 'Gym',
        ]);

        Role::factory()->create([
            'name' => 'Coach',
        ]);

        Role::factory()->create([
            'name' => 'Client',
        ]);

        /**
         * USER SEEDER
         */

        \App\Models\User::factory(10)->create();



        /**
         * SUPER ADMIN SEEDER
         */

         \App\Models\User::factory([
            'name' => 'Disko SuperAdmin',
            'email' => 'disko@super-admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'role_id' => 0,
            'remember_token' => Str::random(10),
         ])->create();

        /**
         * COACH SEEDER
         */

         \App\Models\User::factory([
            'name' => 'Disko Coach',
            'email' => 'disko@coach.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'role_id' => 4,
            'remember_token' => Str::random(10),
         ])->create();

        /**
         * EXERCISE CATEGORY SEEDER
         * todo foreach
         */
        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Abs',
        ]);

        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Back',
        ]);

        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Biceps',
        ]);

        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Cardio',
        ]);

        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Chest',
        ]);

        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Legs',
        ]);

        \App\Models\Exercise\ExerciseCategory::factory()->create([
            'name' => 'Shoulders',
        ]);


        /**
         * EXERCISE TYPE SEEDER
         */

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Reps',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Weight',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Time',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Distance',
        ]);


        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Weight and Reps',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Weight and Distance',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Weight and Time',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Reps and Distance',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Reps and Time',
        ]);

        \App\Models\Exercise\ExerciseType::factory()->create([
            'name' => 'Distance and Time',
        ]);

    }
}

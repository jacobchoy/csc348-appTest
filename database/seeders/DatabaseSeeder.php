<?php

namespace Database\Seeders;

use App\Models\Lavatory;
use App\Models\LavatoryLog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(20)->create();
        $lavatories = Lavatory::factory(5)->create();

        LavatoryLog::factory(35)->create([
            'lavatory_id' => fn () => $lavatories->random()->id,
            'user_id' => fn () => fake()->boolean(80) ? $users->random()->id : null,
        ]);

        Post::factory(25)->create([
            'user_id' => fn () => $users->random()->id,
        ]);
    }
}

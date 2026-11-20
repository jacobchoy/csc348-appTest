<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Lavatory;
use App\Models\LavatoryLog;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $passenger = User::factory()->create([
            'name' => 'test passenger',
            'email' => 'passenger@test.test',
            'password' => Hash::make('123'),
            'role' => 'passenger',
        ]);

        $attendant = User::factory()->create([
            'name' => 'test attendant',
            'email' => 'attendant@test.test',
            'password' => Hash::make('123'),
            'role' => 'attendant',
        ]);

        $users = User::factory(10)->create()->prepend($passenger)->prepend($attendant);
        $users->each(fn (User $user) => Profile::factory()->create(['user_id' => $user->id]));
        $lavatories = Lavatory::factory(4)->create();

        LavatoryLog::factory(10)->create([
            'lavatory_id' => fn () => $lavatories->random()->id,
            'user_id' => fn () => fake()->boolean(80) ? $users->random()->id : null,
        ]);

        $posts = Post::factory(10)->create([
            'user_id' => fn () => $users->random()->id,
        ]);

        $posts->each(function (Post $post) use ($users): void {
            $post->savedByUsers()->attach($users->random(rand(1, 3))->pluck('id'));
            Comment::factory(rand(1, 3))->create([
                'user_id' => fn () => $users->random()->id,
                'commentable_id' => $post->id,
                'commentable_type' => Post::class,
            ]);
        });

        $lavatories->each(function (Lavatory $lavatory) use ($users): void {
            Comment::factory(2)->create([
                'user_id' => fn () => $users->random()->id,
                'commentable_id' => $lavatory->id,
                'commentable_type' => Lavatory::class,
            ]);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostView;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::factory()->create([
            'name' => 'admin',
        ]);
        Role::factory()->create([
            'name' => 'creator',
        ]);
        Role::factory()->create([
            'name' => 'user',
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'hehe1234',
            'bio' => 'This is my Bio',
            'role_id' => 1,
        ]);
        User::factory()->count(50)->create();
        Category::factory()->count(10)->create();
        Post::factory()->count(100)->create();
        Comment::factory()->count(10)->create();
        PostView::factory()->count(1000)->create();
    }
}

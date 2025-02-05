<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('images/posts-images');
        Storage::makeDirectory('images/posts-images');

        User::factory(10)->create();
        $this->call(CategorySeeder::class);
        Post::factory(40)->create();
    }
}

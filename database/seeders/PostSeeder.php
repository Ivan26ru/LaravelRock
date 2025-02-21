<?php

namespace Database\Seeders;

use App\Domain\Models\Post\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(50)->create();
    }
}

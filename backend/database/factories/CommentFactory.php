<?php

namespace Database\Factories;

use App\Domain\Models\Comment;
use App\Domain\Models\Post\Post;
use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'message'    => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'post_id' => Post::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}

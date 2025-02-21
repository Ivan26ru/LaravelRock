<?php

declare(strict_types=1);

namespace App\Infrastrusture\Eloquent\Repositories;

use App\Domain\Models\Post\Post;
use App\Domain\Repositories\FiltersPostInterface;
use App\Domain\Repositories\PostsRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Необходим для работы с бд, вместо Eloquent model
 */
class PostsRepository implements PostsRepositoryInterface
{
    public function get(int $id): Post
    {
        return Post::query()->findOrFail($id);
    }

    public function find(int $id): ?Post
    {
        return Post::query()->find($id);
    }

    public function save(Post $post): void
    {
        $post->save();
    }

    public function postFilter(FiltersPostInterface $filtersPost): array
    {
        $postBuilder = Post::query();
        $postBuilder = $this->addFetchFilter($postBuilder, $filtersPost);
        return $this->getResult($postBuilder)->all();
    }

    private function addFetchFilter(Builder $postBuilder, FiltersPostInterface $filtersPost): Builder
    {
        if ($filtersPost->authorId) {
            $postBuilder = $postBuilder->where('author_id', $filtersPost->authorId);
        }

        return $postBuilder;
    }

    private function getResult(Builder $postQuery): Collection
    {
        return $postQuery->get();
    }

    public function getAuthorIdPost(int $postId): ?int
    {
        $post = $this->find($postId);
        return $post?->author_id;
    }
}

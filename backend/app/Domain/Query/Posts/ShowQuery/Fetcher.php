<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\ShowQuery;

use App\Domain\Repositories\PostsRepositoryInterface;

final readonly class Fetcher
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    ) {
    }

    public function __invoke(Query $query): Result
    {
        $post = $this->postsRepository->find(id: $query->postId);

        if ($post === null) {
            throw new ModelNotFoundException('Post not found in show action');
        }

        return new Result(
            id: $post->id,
            title: $post->title,
            content: $post->content,
            created_at: $post->created_at->format('Y-m-d H:s'),
            author: new AuthorDTO(
                email: $post->author->email,
                name: $post->author->name,
            ),

        );
    }
}

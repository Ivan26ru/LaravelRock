<?php

declare(strict_types=1);

namespace App\Domain\Commands\Posts\UpdateCommand\Form;

use App\Domain\Commands\Posts\UpdateCommand\Update\ModelNotFoundException;
use App\Domain\Repositories\PostsRepositoryInterface;

final readonly class Handler
{

    public function __construct(
        private PostsRepositoryInterface $postsRepository
    ) {
    }

    public function __invoke(int $postId): Result
    {
        $post = $this->postsRepository->find($postId);

        if ($post === null) {
            throw new ModelNotFoundException('Post not found');
        }

        return new Result(
            postId: $post->id,
            title: $post->title,
            content: $post->content,
            author: new AuthorDTO(
                email: $post->author->email,
                name: $post->author->name
            ),
        );
    }

}

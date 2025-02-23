<?php

declare(strict_types=1);

namespace App\Domain\Commands\Posts\StoreCommand\Store;

use App\Domain\Models\Post\Post;
use App\Domain\Repositories\PostsRepositoryInterface;

final readonly class Handler
{
    public function __construct(
        private PostsRepositoryInterface $postRepository
    ) {}

    public function __invoke(Command $dto): void
    {

        $post = Post::create(
            title: $dto->title,
            content: $dto->content,
            authorId: $dto->authorId
        );

        $this->postRepository->save($post);
    }

}

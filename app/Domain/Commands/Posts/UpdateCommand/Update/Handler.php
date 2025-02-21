<?php

declare(strict_types=1);

namespace App\Domain\Commands\Posts\UpdateCommand\Update;

use App\Domain\Models\Post\Title;
use App\Domain\Repositories\PostsRepositoryInterface;

final readonly class Handler
{
    public function __construct(private PostsRepositoryInterface $postRepository) {}

    /**
     * @throws ModelNotFoundException
     */
    public function __invoke(Command $dto): void
    {
        $post = $this->postRepository->find(id: $dto->postId);

        if ($post === null) {
            throw new ModelNotFoundException('Post not found');
        }

        $post->edit(
            title: new Title($dto->title),
            content: $dto->content
        );

        $this->postRepository->save($post);
    }

}

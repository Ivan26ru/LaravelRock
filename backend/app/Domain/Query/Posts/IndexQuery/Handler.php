<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery;

use App\Domain\Query\Posts\IndexQuery\Filters\FilterInterface;
use App\Domain\Repositories\PostsRepositoryInterface;
use App\Domain\Repositories\UsersRepositoryInterface;

final readonly class Handler
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository,
        private UsersRepositoryInterface $authorRepository,

    ) {
    }

    public function __invoke(FiltersDTO $filters): Result
    {
        return new Result(
            posts: $this->getPostCollection(filters: $filters),
            filters: $this->getFilterCollection()
        );
    }

    /**
     * @param FiltersDTO $filters
     * @return PostDTO[]
     * @throws \DateMalformedStringException
     */
    private function getPostCollection(

        FiltersDTO $filters): array
    {
        $postModels = $this->postsRepository->postFilter(filtersPost: $filters);

        $postCollection = [];

        foreach ($postModels as $post) {
            $authorModel = $this->authorRepository->find($post->author_id);

            if ($authorModel) {
                $authorDto = new AuthorDTO(
                    email: $authorModel->email,
                    name: $authorModel->name,
                );

                $postCollection[] = new PostDTO(
                    id: $post->id,
                    title: $post->title,
                    content: $post->content,
                    created_at: $post->created_at->toDateTimeImmutable(),
                    author: $authorDto,
                );
            }
        }

        return $postCollection;
    }

    /**
     * @return FilterInterface[]
     */
    private function getFilterCollection(): array
    {
        return (new FilterCollection())->getFilters();
    }
}

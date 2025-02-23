<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery;

use App\Domain\Query\Posts\IndexQuery\Filters\Author\FilterAuthor;
use App\Domain\Query\Posts\IndexQuery\Filters\Author\FilterAuthorItemDTO;
use App\Domain\Query\Posts\IndexQuery\Filters\FilterInterface;
use App\Domain\Repositories\UsersRepositoryInterface;

class FilterCollection
{
    public function __construct(private array $filters = [])
    {
        $this->addFilter($this->getAuthorFilter());
    }

    /**
     * @return FilterInterface[] array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    private function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    private function getAuthorFilter(): FilterInterface
    {
        return new FilterAuthor(
            title: 'Автор',
            key: 'authorId',
            itemCollection: $this->getAuthorCollection()
        );
    }

    private function getAuthorCollection(): array
    {
        /** @var FilterAuthorItemDTO[] $filterAuthorDTO */
        $filterAuthorDTO = [];

        $userModels = app(UsersRepositoryInterface::class)->fetchAll();

        foreach ($userModels as $filterAuthorModel) {
            $FilterAuthorDTO = new FilterAuthorItemDTO(
                id: $filterAuthorModel->id,
                email: $filterAuthorModel->email,
                name: $filterAuthorModel->name,
            );

            $filterAuthorDTO[] = $FilterAuthorDTO;
        }

        return $filterAuthorDTO;
    }
}

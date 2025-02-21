<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery\Filters\Author;

use App\Domain\Query\Posts\IndexQuery\Filters\FilterInterface;

final readonly class FilterAuthor implements FilterInterface
{
    /**
     * @param string $title
     * @param string $key
     * @param FilterAuthorItemDTO[] $itemCollection
     */
    public function __construct(
        public string $title,
        public string $key,
        public array $itemCollection
    ) {
    }
}

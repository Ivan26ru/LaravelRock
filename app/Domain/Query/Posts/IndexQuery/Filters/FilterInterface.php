<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery\Filters;

use App\Domain\Query\Posts\IndexQuery\Filters\Author\FilterAuthorItemDTO;

interface FilterInterface
{
    /**
     * @param string $title
     * @param string $key
     * @param FilterAuthorItemDTO[] $itemCollection
     */
    public function __construct(string $title, string $key, array $itemCollection);
}

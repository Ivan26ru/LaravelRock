<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery;

use App\Domain\Query\Posts\IndexQuery\Filters\FilterInterface;

final readonly class Result
{
    /**
     * @param PostDTO[] $posts
     * @param FilterInterface[] $filters
     */
    public function __construct(
        public array $posts,
        public array $filters
    ) {
    }
}

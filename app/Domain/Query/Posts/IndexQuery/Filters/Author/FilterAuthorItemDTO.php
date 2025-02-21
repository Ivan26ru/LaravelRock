<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery\Filters\Author;

final readonly class FilterAuthorItemDTO
{
    public function __construct(
        public int $id,
        public string $email,
        public string $name,
    ) {
    }
}

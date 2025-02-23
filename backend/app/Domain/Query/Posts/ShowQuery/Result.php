<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\ShowQuery;

final readonly class Result
{
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public string $created_at,
        public AuthorDTO $author
    ) {}
}

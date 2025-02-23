<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery;

use DateTimeImmutable;

final readonly class PostDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public DateTimeImmutable $created_at,
        public AuthorDTO $author
    ) {
    }
}

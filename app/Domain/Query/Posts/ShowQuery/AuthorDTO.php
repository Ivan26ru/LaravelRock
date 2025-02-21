<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\ShowQuery;

final readonly class AuthorDTO
{
    public function __construct(
        public string $email,
        public string $name,
    ) {}
}

<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\IndexQuery;

use App\Domain\Repositories\FiltersPostInterface;

final readonly class FiltersDTO implements FiltersPostInterface
{
    public function __construct(
        public ?int $authorId,
    ) {
    }
}

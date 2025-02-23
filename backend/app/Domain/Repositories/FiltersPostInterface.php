<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

interface FiltersPostInterface
{
    public function __construct(?int $authorId);
}

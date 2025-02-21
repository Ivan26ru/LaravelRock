<?php

declare(strict_types=1);

namespace App\Domain\Query\Posts\ShowQuery;

final readonly class Query
{
public function __construct(public int $postId)
{
}
}

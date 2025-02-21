<?php

declare(strict_types=1);

namespace App\Domain\Commands\Posts\StoreCommand\Store;

final readonly class Command
{
    public function __construct(
        public string $title,
        public string $content,
        public int $authorId,
    ) {
    }
}

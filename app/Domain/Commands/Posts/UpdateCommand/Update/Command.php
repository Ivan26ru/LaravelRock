<?php

declare(strict_types=1);

namespace App\Domain\Commands\Posts\UpdateCommand\Update;

final readonly class Command
{
    public function __construct(
        public int $postId,
        public string $title,
        public string $content,
    ) {
    }
}

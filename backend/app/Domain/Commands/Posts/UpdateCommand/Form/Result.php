<?php

declare(strict_types=1);

namespace App\Domain\Commands\Posts\UpdateCommand\Form;

final readonly class Result
{
    public function __construct(
        public int $postId,
        public string $title,
        public string $content,
        public AuthorDTO $author,
    ) {
    }
}

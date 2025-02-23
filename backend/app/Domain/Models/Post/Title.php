<?php

declare(strict_types=1);

namespace App\Domain\Models\Post;

use Webmozart\Assert\Assert;

/**
 * Часть модели предметной области
 * Проверка email на валидность
 */
final readonly class Title
{
    public string $title;

    public function __construct(
        string $title,
    ) {
        $this->title = trim($title);
        Assert::notEmpty(trim($this->title));
    }
}

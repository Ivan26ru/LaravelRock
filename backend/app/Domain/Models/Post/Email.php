<?php

declare(strict_types=1);

namespace App\Domain\Models\Post;

use Webmozart\Assert\Assert;

/**
 * Часть модели предметной области
 * Проверка email на валидность
 */
final readonly class Email
{
    public function __construct(
        public string $email,
    ) {
        Assert::notEmpty($email);
        Assert::email($email);
    }
}

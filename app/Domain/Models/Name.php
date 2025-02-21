<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Webmozart\Assert\Assert;

/**
 * Часть модели предметной области
 * Проверка name на валидность
 */
final readonly class Name
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $middleName = '',
    ) {
        Assert::notEmpty($this->firstName);
        Assert::notEmpty($this->lastName);
    }

    public function getFullName(): string
    {
        $fullNameArray = [
            $this->firstName,
            $this->lastName,
        ];

        if (!empty($this->middleName)) {
            $fullNameArray[] = $this->middleName;
        }

        return implode(
            ' ',
            $fullNameArray
        );
    }
}

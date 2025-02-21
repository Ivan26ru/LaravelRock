<?php

declare(strict_types=1);

namespace App\Domain\Repositories;


use App\Domain\Models\User;

/**
 * Необходим для работы с бд, вместо Eloquent model
 */
interface UsersRepositoryInterface
{
    /**
     * @return User[]
     */
    public function fetchAll(): array;

    public function find(int $id): null|User;
}

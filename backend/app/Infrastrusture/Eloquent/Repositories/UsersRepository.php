<?php

declare(strict_types=1);

namespace App\Infrastrusture\Eloquent\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UsersRepositoryInterface;

/**
 * Необходим для работы с бд, вместо Eloquent model
 */
class UsersRepository implements UsersRepositoryInterface
{
    public function fetchAll(): array
    {
        return User::all()->all();
    }

    public function find(int $id): null|User
    {
        return User::find($id);
    }
}

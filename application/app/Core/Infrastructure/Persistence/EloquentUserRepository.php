<?php

namespace App\Core\Infrastructure\Persistence;

use App\Core\Domain\Entities\User\User;
use App\Core\Domain\Repositories\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(array $attributes): User
    {
        return User::create($attributes);
    }
}

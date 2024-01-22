<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\User\User;


interface UserRepositoryInterface
{
    public function create(array $attributes): User;
}

<?php

namespace App\Core\Application\Admin\Auth;

interface RegisterUserServiceInterface
{
    /**
     * Perform user registration.
     *
     * @param array $userData
     * @return mixed
     */
    public function register(array $userData);
}

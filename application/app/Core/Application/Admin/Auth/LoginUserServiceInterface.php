<?php

namespace App\Core\Application\Admin\Auth;

interface LoginUserServiceInterface
{
    /**
     * Perform user login.
     *
     * @param array $userData
     * @return mixed
     */
    public function login(array $userData);
}

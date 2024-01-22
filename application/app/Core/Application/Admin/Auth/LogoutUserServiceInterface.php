<?php

namespace App\Core\Application\Admin\Auth;

interface LogoutUserServiceInterface
{
    /**
     * Perform user logout.
     * @return mixed
     */
    public function logout();
}

<?php

namespace App\Core\Application\Admin\Auth;

class LogoutUserService  implements LogoutUserServiceInterface
{

    /**
     * Logout the currently authenticated user.
     *
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }
}

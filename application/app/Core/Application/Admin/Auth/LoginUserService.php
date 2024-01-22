<?php

namespace App\Core\Application\Admin\Auth;

use Illuminate\Support\Facades\Auth;

class LoginUserService  implements LoginUserServiceInterface
{
    /**
     * Authenticate a user.
     *
     * @param array $credentials
     * @return mixed
     */
    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }
}

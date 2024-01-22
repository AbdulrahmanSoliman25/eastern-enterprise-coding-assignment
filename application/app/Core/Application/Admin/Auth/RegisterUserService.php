<?php

namespace App\Core\Application\Admin\Auth;

use Illuminate\Support\Facades\Hash;
use App\Core\Domain\Entities\User\User;
use App\Core\Domain\Repositories\UserRepositoryInterface;

class RegisterUserService implements RegisterUserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * RegisterUserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Perform user registration.
     *
     * @param array $userData
     * @return mixed
     */
    public function register(array $userData)
    {
        $user = [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ];

        $this->userRepository->create($user);

        return $user;
    }
}

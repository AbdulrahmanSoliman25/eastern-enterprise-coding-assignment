<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Core\Application\Admin\Auth\LoginUserService;

class Login extends Component
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('app.login');
    }

    public function login(LoginUserService $loginUserService)
    {
        try {
            $validated = $this->validate();
            if ($loginUserService->login($validated)) {
                return redirect()->to('/dashboard');
            } else {
                $this->addError('email', 'Invalid credentials');
            }
        } catch (\Exception $e) {
            $this->addError('registrationError', 'An error occurred during registration.');
        }
    }
}

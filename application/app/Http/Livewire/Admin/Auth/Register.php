<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Core\Application\Admin\Auth\RegisterUserService;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('app.register');
    }

    public function register(RegisterUserService $registerUserService)
    {
        try {
            $registerUserService->register($this->validate());
            $this->reset(['name', 'email', 'password']);
            return redirect()->to('/login');
        } catch (\Exception $e) {
            $this->addError('registrationError', 'An error occurred during registration.');
        }
    }
}

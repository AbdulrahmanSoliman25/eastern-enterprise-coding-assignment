<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use App\Core\Application\Admin\Auth\LogoutUserService;

class Logout extends Component
{
    public function render()
    {
        return view('app.logout');
    }

    public function logout(LogoutUserService  $logoutUserService)
    {
        $logoutUserService->logout();

        return redirect()->to('/login');
    }
}

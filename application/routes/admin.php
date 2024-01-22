<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Auth\Login;
use App\Http\Livewire\Admin\Auth\Register;
use App\Http\Livewire\Admin\Company\Companies;
use App\Http\Livewire\Admin\Dashboard\Dashboard;

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/companies', Companies::class)->name('dashboard.companies');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

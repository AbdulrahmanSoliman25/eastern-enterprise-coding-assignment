<?php

namespace Tests\Unit\Auth;

use App\Core\Application\Admin\Auth\LoginUserService;
use App\Http\Livewire\Admin\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_login_page()
    {
        Livewire::test(Login::class)
            ->assertSee('login');
    }

    /** @test */
    public function it_can_login_with_valid_credentials()
    {

        Livewire::test(Login::class)
            ->set('email', 'admin@admin.com')
            ->set('password', '123456789')
            ->call('login', app(LoginUserService::class))
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function it_cannot_login_with_invalid_credentials()
    {
        Livewire::test(Login::class)
            ->set('email', 'nonexistent@example.com')
            ->set('password', 'invalidpassword')
            ->call('login', app(LoginUserService::class))
            ->assertHasErrors(['email' => 'Invalid credentials']);
    }

    /** @test */
    public function it_handles_exception_during_login()
    {
        $this->instance(LoginUserService::class, \Mockery::mock(LoginUserService::class, function ($mock) {
            $mock->shouldReceive('login')->andThrow(new \Exception('Test Exception'));
        }));

        Livewire::test(Login::class)
            ->set('email', 'test@example.com')
            ->set('password', 'password123')
            ->call('login', app(LoginUserService::class))
            ->assertHasErrors(['registrationError' => 'An error occurred during registration.']);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Admin\Company\Companies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Core\Application\Admin\Company\CompaniesService;

class CompaniesFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_companies_page()
    {
        Livewire::test(Companies::class)
            ->assertStatus(200);
    }

    // /** @test */
    // public function it_can_paginate_results()
    // {
    //     Livewire::test(Companies::class)
    //         ->assertSee('Amazon')
    //         ->assertSee('Oracle')
    //         ->assertDontSee('PayPal')
    //         ->call('gotoPage', 2)
    //         ->assertSee('PayPal');
    // }

    // /** @test */
    // public function it_can_sort_results()
    // {

    //     Livewire::test(Companies::class)
    //         ->assertSeeInOrder(['Amazon', 'Microsoft', 'Facebook', 'Tesla'])
    //         ->call('sortBy', 'name')
    //         ->assertSeeInOrder(['Tesla', 'Facebook', 'Microsoft', 'Amazon']);
    // }

    /** @test */
    public function it_handles_validation_errors()
    {
        Livewire::test(Companies::class)
            ->set('name', '')
            ->call('save', app(CompaniesService::class))
            ->assertHasErrors(['name' => 'required']);
    }

    // TODO:after setting toaster
    // /** @test */
    // public function it_displays_success_message_after_create()
    // {
    //     Livewire::test(Companies::class)
    //         ->set('name', 'New Company')
    //         ->set('description', 'Description of the new company')
    //         ->set('address', '123 Main St')
    //         ->set('logo', UploadedFile::fake()->image('logo.jpg'))
    //         ->call('save', app(CompaniesService::class))
    //         ->assertSee('Record saved successfully!!');
    // }

    // /** @test */
    // public function it_displays_success_message_after_update()
    // {
    //     $company = Company::create(
    //         [
    //             'name' => 'Amazon',
    //             'description' => 'An American multinational technology company', 'address' => 'Seattle, Washington, United States',
    //             'logo' => 'storage/logos/logo.jpg',
    //             'symbol' => 'AMZN'
    //         ],
    //     );
    //     Livewire::test(Companies::class)
    //         ->set('id', $company->id)
    //         ->set('name', 'Updated Company')
    //         ->set('description', 'Updated description')
    //         ->set('address', '456 Updated St')
    //         ->set('logo', UploadedFile::fake()->image('updated_logo.jpg'))
    //         ->call('save', app(CompaniesService::class))
    //         ->assertSee('Record saved successfully!!');
    // }

    // /** @test */
    // public function it_displays_success_message_after_delete()
    // {
    //     $company = Company::create(
    //         [
    //             'name' => 'Amazon',
    //             'description' => 'An American multinational technology company', 'address' => 'Seattle, Washington, United States',
    //             'logo' => 'storage/logos/logo.jpg',
    //             'symbol' => 'AMZN'
    //         ],
    //     );
    //     Livewire::test(Companies::class)
    //         ->call('deleteId', $company->id)
    //         ->call('delete', app(CompaniesService::class))
    //         ->assertSee('Record deleted successfully!!');
    // }
}

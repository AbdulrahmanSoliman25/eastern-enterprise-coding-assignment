<?php

namespace Tests\Unit\Company;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Core\Domain\Entities\Company\Company;
use App\Http\Livewire\Admin\Company\Companies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Core\Application\Admin\Company\CompaniesService;

class CompaniesUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_open_and_close_form_modal()
    {
        Livewire::test(Companies::class)
            ->call('closeFormModal')
            ->assertSet('isFormOpen', false);
    }

    /** @test */
    public function it_can_load_company_data_for_edit()
    {
        $company = Company::create(
            [
                'name' => 'Amazon',
                'description' => 'An American multinational technology company', 'address' => 'Seattle, Washington, United States',
                'logo' => 'storage/logos/logo.jpg',
                'symbol' => 'AMZN'
            ],
        );

        Livewire::test(Companies::class)
            ->call('edit', $company->id)
            ->assertSet('id', $company->id)
            ->assertSet('name', $company->name)
            ->assertSet('description', $company->description)
            ->assertSet('address', $company->address)
            ->assertSet('logo', $company->logo);
    }

    /** @test */
    public function it_can_create_company()
    {
        Storage::fake('public');

        Livewire::test(Companies::class)
            ->set('name', 'New Company')
            ->set('description', 'Description of the new company')
            ->set('address', '123 Main St')
            ->set('logo', UploadedFile::fake()->image('logo.jpg'))
            ->call('save', app(CompaniesService::class))
            ->assertStatus(200);

        $this->assertDatabaseHas('companies', ['name' => 'New Company']);
    }

    /** @test */
    public function it_can_update_company()
    {
        $company = Company::create(
            [
                'name' => 'Amazon',
                'description' => 'An American multinational technology company', 'address' => 'Seattle, Washington, United States',
                'logo' => 'storage/logos/logo.jpg',
                'symbol' => 'AMZN'
            ],
        );
        Storage::fake('public');

        Livewire::test(Companies::class)
            ->set('id', $company->id)
            ->set('name', 'Updated Company')
            ->set('description', 'Updated description')
            ->set('address', '456 Updated St')
            ->set('logo', UploadedFile::fake()->image('updated_logo.jpg'))
            ->call('save', app(CompaniesService::class))
            ->assertStatus(200);

        $this->assertDatabaseHas('companies', ['name' => 'Updated Company']);
    }

    /** @test */
    public function it_can_delete_company()
    {
        $company = Company::create(
            [
                'name' => 'Amazon',
                'description' => 'An American multinational technology company', 'address' => 'Seattle, Washington, United States',
                'logo' => 'storage/logos/logo.jpg',
                'symbol' => 'AMZN'
            ],
        );
        Livewire::test(Companies::class)
            ->call('deleteId', $company->id)
            ->call('delete', app(CompaniesService::class))
            ->assertStatus(200);
        $this->assertNotNull(Company::withTrashed()->find($company->id)->deleted_at);
    }
}

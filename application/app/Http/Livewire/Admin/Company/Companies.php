<?php

namespace App\Http\Livewire\Admin\Company;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Core\Application\Admin\Company\CompaniesService;

class Companies extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $currentPage = 1;
    public $perPage = 10;
    public $lastPage = 1;

    public $sortField = 'name';
    public $sortDirection = 'asc';
    protected $queryString = ['sortField', 'sortDirection'];

    // Form Fields
    public $id = null;
    public $name = '';
    public $description = '';
    public $address = '';
    public $logo = null;

    // Modal
    public $isFormOpen = false;
    public $isDeleteModalOpen = false;

    private $companiesService;

    public function mount(CompaniesService $companiesService)
    {
        $this->companiesService = $companiesService;
    }

    // Validation Rules
    protected function rules()
    {
        $dynamicLogoRules = function ($attribute, $value, $fail) {
            $rules['logo'] = $value instanceof UploadedFile
                ? ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
                : 'nullable';
        };

        return [
            'name' => 'required',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => [
                'sometimes',
                $dynamicLogoRules,
            ],
        ];
    }

    // Actions
    public function gotoPage($page)
    {
        $this->currentPage = $page;
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->lastPage) {
            $this->currentPage++;
        }
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection == 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function deleteId($id)
    {
        $this->id = $id;
        $this->isDeleteModalOpen = true;
    }

    public function closeDelete()
    {
        $this->id = '';
        $this->isDeleteModalOpen = false;
    }

    public function delete(CompaniesService $companiesService)
    {
        try {
            $companiesService->delete($this->id);
            $this->closeDelete();
            session()->flash('success', 'Record deleted successfully!!');
        } catch (\Exception $ex) {
            session()->flash('success', 'Something went wrong!!');
        }
    }

    public function edit(CompaniesService $companiesService, $id = null)
    {
        try {
            $this->loadCompanyData($companiesService, $id);
            $this->isFormOpen = true;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something went wrong!!');
        }
    }

    public function save(CompaniesService $companiesService)
    {
        $validatedData = $this->validate($this->rules());
        try {
            $this->id
                ? $this->updateCompany($companiesService, $validatedData)
                : $this->createCompany($companiesService, $validatedData);

            $this->closeFormModal();
            session()->flash('success', 'Record saved successfully!!');
        } catch (\Exception $ex) {
            session()->flash('success', 'Something went wrong!!');
        }
    }
    public function closeFormModal()
    {
        $this->isFormOpen = false;
        $this->reset();
    }

    private function updateCompany($companiesService, $data)
    {
        return $companiesService->update($this->id, $this->saveLogo($data));
    }

    private function createCompany($companiesService, $data)
    {
        if ($this->logo  == null) {
            $data['logo'] = 'storage/logos/logo.jpg';
        }
        return $companiesService->create($this->saveLogo($data));
    }

    private function saveLogo($data)
    {
        if ($this->logo instanceof UploadedFile) {
            $extension = $this->logo->getClientOriginalExtension();
            $logoName = Str::random(10) . '.' . $extension;
            $this->logo->storeAs('logos/', $logoName, 'public');
            $data['logo'] =  'storage/logos/' . $logoName;
        }
        return $data;
    }

    private function loadCompanyData($companiesService, $id)
    {
        $this->id = $id;
        if (!empty($this->id)) {
            $company = $companiesService->show($this->id);
            if ($company) {
                $this->name = $company->name;
                $this->description = $company->description;
                $this->address = $company->address;
                $this->logo = $company->logo;
            }
        }
    }

    #[Layout('layouts.app')]
    public function render(CompaniesService $companiesService)
    {
        $companies = $companiesService->all([
            'sortField' => $this->sortField,
            'sortDirection' =>   $this->sortDirection,
            'perPage' => $this->perPage,
            'currentPage' => $this->currentPage
        ]);
        $this->lastPage =  $companies->lastPage();
        return view('app.companies', [
            'companies' => $companies,
        ]);
    }

}

<?php

namespace App\Http\Livewire\Guest\Company;


use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Core\Application\Admin\Company\CompaniesService;

class Companies extends Component
{
    public $currentPage = 1;
    public $perPage = 10;
    public $lastPage = 1;

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

    #[Layout('layouts.guest')]
    public function render(CompaniesService $companiesService)
    {
        $companies = $companiesService->all([
            'sortField' => 'id',
            'sortDirection' => 'asc',
            'perPage' => $this->perPage,
            'currentPage' => $this->currentPage
        ]);
        $this->lastPage =  $companies->lastPage();
        return view('guest.companies', [
            'companies' => $companies,
        ]);
    }
}

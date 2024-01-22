<?php

namespace App\Http\Livewire\Guest\Company;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Core\Application\Guest\Company\GetCompanyService;

class CompanyDetails extends Component
{
    public $company;
    public $financialDetails = [
        'p' => 0,
        't' => 0,
        'v' => 0,
    ];

    private $getCompanyService;

    public function mount(GetCompanyService $getCompanyService, $companyId)
    {
        $this->getCompanyService = $getCompanyService;
        $this->company = $this->getCompanyService->show($companyId);
    }

    #[On('financial-details-updated')]
    public function updateFinancialDetails($value)
    {
        $value['t'] = Carbon::createFromTimestampMs($value['t'])->toDateTimeString();
        $this->financialDetails = $value;
    }


    #[Layout('layouts.guest')]
    public function render()
    {
        return view('guest.company-details');
    }
}

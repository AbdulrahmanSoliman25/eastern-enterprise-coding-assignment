<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Guest\Company\Companies;
use App\Http\Livewire\Guest\Company\CompanyDetails;


Route::middleware(['guest'])->group(function () {
    Route::get('/', Companies::class)->name('guest.companies');
    Route::get('company-details/{companyId}', CompanyDetails::class)->name('guest.company-details-page');
});

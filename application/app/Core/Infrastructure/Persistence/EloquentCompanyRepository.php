<?php

namespace App\Core\Infrastructure\Persistence;

use Illuminate\Support\Facades\Storage;
use App\Core\Domain\Entities\Company\Company;
use App\Core\Domain\Repositories\CompanyRepositoryInterface;

class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    public function all(array $fillter)
    {
        return Company::orderBy($fillter['sortField'], $fillter['sortDirection'])->paginate($fillter['perPage'], ['*'], 'page', $fillter['currentPage']);
    }

    public function create(array $data)
    {
        return Company::create($data);
    }

    public function show(int $companyId)
    {
        return Company::findOrFail($companyId);
    }

    public function update(int $companyId, array $data)
    {
        $company = Company::findOrFail($companyId);

        $company->update($data);

        return $company;
    }

    public function delete(int $companyId)
    {
        $company = Company::findOrFail($companyId);

        if ($company->logo) {
            Storage::delete($company->logo);
        }

        $company->delete();

        return true;
    }
}

<?php

namespace App\Core\Application\Guest\Company;


interface GetCompanyServiceInterface
{
    /**
     * Get a single company by ID.
     *
     * @param int $companyId
     * @return mixed
     */
    public function show(int $companyId);
}

<?php

namespace App\Core\Application\Guest\Company;


interface ListCompaniesServiceInterface
{
    /**
     * Get all companies.
     *
     * @return mixed
     */
    public function all(array $filter);
}

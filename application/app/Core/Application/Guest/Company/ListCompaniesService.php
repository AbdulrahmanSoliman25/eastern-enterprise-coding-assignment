<?php

namespace App\Core\Application\Guest\Company;

use App\Core\Domain\Repositories\CompanyRepositoryInterface;
use App\Core\Application\Guest\Company\ListCompaniesServiceInterface;

class ListCompaniesService implements ListCompaniesServiceInterface
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * CompaniesService constructor.
     *
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Get all companies.
     *
     * @param array $filter
     * @return mixed
     */
    public function all(array $filter)
    {
        return $this->companyRepository->all($filter);
    }
}

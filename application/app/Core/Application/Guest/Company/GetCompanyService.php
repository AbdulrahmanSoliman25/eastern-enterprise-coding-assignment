<?php

namespace App\Core\Application\Guest\Company;

use App\Core\Domain\Repositories\CompanyRepositoryInterface;

class GetCompanyService implements GetCompanyServiceInterface
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
     * Get a single company by ID.
     *
     * @param int $companyId
     * @return mixed
     */
    public function show(int $companyId)
    {
        return $this->companyRepository->show($companyId);
    }
}

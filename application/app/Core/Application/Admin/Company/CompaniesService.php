<?php

namespace App\Core\Application\Admin\Company;

use App\Core\Domain\Repositories\CompanyRepositoryInterface;
use App\Core\Application\Admin\Company\CompaniesServiceInterface;

class CompaniesService  implements CompaniesServiceInterface
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

    /**
     * Create a new company.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->companyRepository->create($data);
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

    /**
     * Update an existing company.
     *
     * @param int $companyId
     * @param array $data
     * @return mixed
     */
    public function update(int $companyId, array $data)
    {
        return $this->companyRepository->update($companyId, $data);
    }

    /**
     * Delete a company.
     *
     * @param int $companyId
     * @return mixed
     */
    public function delete(int $companyId)
    {
        return $this->companyRepository->delete($companyId);
    }
}

<?php

namespace App\Core\Application\Admin\Company;


interface CompaniesServiceInterface
{
    /**
     * Get all companies.
     *
     * @param array $filter
     * @return mixed
     */
    public function all(array $filter);

    /**
     * Create a new company.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Get a single company by ID.
     *
     * @param int $companyId
     * @return mixed
     */
    public function show(int $companyId);

    /**
     * Update an existing company.
     *
     * @param int $companyId
     * @param array $data
     * @return mixed
     */
    public function update(int $companyId, array $data);

    /**
     * Delete a company.
     *
     * @param int $companyId
     * @return mixed
     */
    public function delete(int $companyId);
}

<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Employee;
use App\Model\EmployeeShow\Employee as EmployeeShow;

/**
 * Interface EmployeeServiceInterface
 * @package App\Service
 */
interface EmployeeServiceInterface
{
    /**
     * @param Employee $employee
     * @return int
     */
    public function createEmployee(Employee $employee): int;

    /**
     * @param int $employeeId
     * @return EmployeeShow
     */
    public function show(int $employeeId): EmployeeShow;

    /**
     * @param int $employeeId
     * @return Employee
     */
    public function createUpdateData(int $employeeId): Employee;

    /**
     * @param Employee $employee
     * @return int
     */
    public function update(Employee $employee): int;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}

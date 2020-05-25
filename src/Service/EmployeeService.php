<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Extractor\ExtractorInterface;
use App\Hydrator\HydratorInterface;
use App\Model\Employee;
use App\Model\EmployeeShow\Employee as EmployeeShow;

/**
 * Class EmployeeService
 * @package App\Service
 */
class EmployeeService implements EmployeeServiceInterface
{
    /**
     * @var CarServiceClient
     */
    private CarServiceClient $client;

    /**
     * @var ExtractorInterface
     */
    private ExtractorInterface $extractor;

    /**
     * @var HydratorInterface
     */
    private HydratorInterface $hydrator;

    /**
     * EmployeeService constructor.
     * @param CarServiceClient $client
     * @param ExtractorInterface $extractor
     * @param HydratorInterface $hydrator
     */
    public function __construct(CarServiceClient $client, ExtractorInterface $extractor, HydratorInterface $hydrator)
    {
        $this->client = $client;
        $this->extractor = $extractor;
        $this->hydrator = $hydrator;
    }

    /**
     * @param Employee $employee
     * @return int
     */
    public function createEmployee(Employee $employee): int
    {
        $data = $this->getExtractor()->extract($employee);

        return $this->getClient()->createEmployee($data);
    }

    /**
     * @param int $employeeId
     * @return EmployeeShow
     */
    public function show(int $employeeId): EmployeeShow
    {
        $employee = new EmployeeShow();
        $data = $this->getClient()->getEmployee($employeeId);
        $this->getHydrator()->hydrate($data, $employee);

        return $employee;
    }

    /**
     * @param int $employeeId
     * @return Employee
     */
    public function createUpdateData(int $employeeId): Employee
    {
        $employeeShow = $this->show($employeeId);
        $employee = new Employee();
        $employee->setPhone($employeeShow->getPhone())
            ->setId($employeeShow->getId())
            ->setPatronymic($employeeShow->getPatronymic())
            ->setStartDate($employeeShow->getStartDate())
            ->setSurname($employeeShow->getSurname())
            ->setName($employeeShow->getName())
            ->setPosition($employeeShow->getPositionType());

        return $employee;
    }

    /**
     * @param Employee $employee
     * @return int
     */
    public function update(Employee $employee): int
    {
        $employee = $this->getExtractor()->extract($employee);

        return $this->getClient()->updateEmployee($employee);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->getClient()->deleteEmployee($id);
    }

    /**
     * @return CarServiceClient
     */
    public function getClient(): CarServiceClient
    {
        return $this->client;
    }

    /**
     * @return ExtractorInterface
     */
    public function getExtractor(): ExtractorInterface
    {
        return $this->extractor;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator(): HydratorInterface
    {
        return $this->hydrator;
    }
}

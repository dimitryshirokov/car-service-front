<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Exception\CarServiceException;
use App\Client\Exception\ConnectionException;
use App\Client\Exception\ValidationException;
use Graze\GuzzleHttp\JsonRpc\Client as RpcClient;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class CarServiceClient
 * @package App\Client
 */
class CarServiceClient
{
    private const METHOD_GET_POSITIONS = 'getPositions'; // Метод для получения должностей
    private const METHOD_CREATE_EMPLOYEE = 'createEmployee'; // Метод создания работника
    private const METHOD_GET_EMPLOYERS = 'getEmployers'; // Метод получения работников (с лимитом и стартом)
    private const METHOD_CREATE_WORK = 'createWork'; // Метод создания нового вида работ
    private const METHOD_GET_WORKS = 'getWorks'; // Метод получения всех работ (с лимитом и стартом)
    private const METHOD_GET_WORKS_AND_EMPLOYERS = 'getWorksAndEmployers'; // Работы и работники, которые могут выполнять
    private const METHOD_CREATE_ORDER = 'createOrder'; // Метод создания заказа
    private const METHOD_GET_ORDER = 'getOrder'; // Метод просмотра заказа
    private const METHOD_CREATE_CUSTOMER = 'createCustomer'; // Метод создания клиента
    private const METHOD_GET_CUSTOMER = 'getCustomer'; // Метод просмотра клиента
    private const METHOD_UPDATE_CUSTOMER = 'updateCustomer'; // Метод обновления клиента
    private const METHOD_FIND_CUSTOMER = 'findCustomer'; // Метод поиска клиента
    private const METHOD_CHANGE_ORDER_STATUS = 'changeOrderStatus'; // Метод смены статуса заказа
    private const METHOD_FIND_ORDER = 'findOrder'; // Метод поиска заказа
    private const METHOD_GET_ORDERS = 'getOrders'; // Метод получения всех заказов (с лимитом, стартом и статусом)
    private const METHOD_GET_CUSTOMERS = 'getCustomers'; // Метод получения всех клиентов (с лимитом и статусом)
    private const METHOD_CREATE_CAR = 'createCar'; // Метод создания автомобиля
    private const METHOD_GET_CAR = 'getCar'; // Метод просмотра автомобиля
    private const METHOD_GET_CARS = 'getCars'; // Метод получения всех автомобилей (с лимитом и стартом)
    private const METHOD_FIND_CAR = 'findCar'; // Метод поиска автомобиля
    private const METHOD_GET_EMPLOYEE = 'getEmployee'; // Метод просмотра работника
    private const METHOD_UPDATE_EMPLOYEE = 'updateEmployee'; // Метод обновления работника
    private const METHOD_DELETE_EMPLOYEE = 'deleteEmployee'; // Метод удаления работника
    private const METHOD_GET_RESUME = 'getResume'; // Метод получения "Сводки" для главной страницы

    /**
     * @var RpcClient
     */
    private RpcClient $rpcClient;

    /**
     * Client constructor.
     * @param RpcClient $rpcClient
     */
    public function __construct(RpcClient $rpcClient)
    {
        $this->rpcClient = $rpcClient;
    }

    /**
     * @return array
     */
    public function getPositions(): array
    {
        $result = $this->execute(self::METHOD_GET_POSITIONS);

        return $result['positions'];
    }

    /**
     * @param array $data
     * @return int
     */
    public function createEmployee(array $data): int
    {
        $result = $this->execute(self::METHOD_CREATE_EMPLOYEE, $data);

        return (int) $result['employeeId'];
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getEmployers(int $limit, int $offset): array
    {
        return $this->execute(self::METHOD_GET_EMPLOYERS, [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * @param array $data
     * @return int
     */
    public function createWork(array $data): int
    {
        $result = $this->execute(self::METHOD_CREATE_WORK, $data);

        return (int) $result['workId'];
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getWorks(int $limit, int $offset): array
    {
        return $this->execute(self::METHOD_GET_WORKS, [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * @return array
     */
    public function getWorksAndEmployers(): array
    {
        return $this->execute(self::METHOD_GET_WORKS_AND_EMPLOYERS);
    }

    /**
     * @param array $data
     * @return int
     */
    public function createOrder(array $data): int
    {
        $result = $this->execute(self::METHOD_CREATE_ORDER, $data);

        return (int) $result['orderId'];
    }

    /**
     * @param int $orderId
     * @return array
     */
    public function getOrder(int $orderId): array
    {
        $result = $this->execute(self::METHOD_GET_ORDER, [
            'orderId' => $orderId,
        ]);

        return $result['order'];
    }

    /**
     * @param array $data
     * @return int
     */
    public function createCustomer(array $data): int
    {
        $result = $this->execute(self::METHOD_CREATE_CUSTOMER, $data);

        return $result['customerId'];
    }

    /**
     * @param int $customerId
     * @return array
     */
    public function getCustomer(int $customerId): array
    {
        $result = $this->execute(self::METHOD_GET_CUSTOMER, [
            'customerId' => $customerId,
        ]);

        return $result['customer'];
    }

    /**
     * @param array $data
     * @return int
     */
    public function updateCustomer(array $data): int
    {
        $result = $this->execute(self::METHOD_UPDATE_CUSTOMER, $data);

        return $result['customerId'];
    }

    /**
     * @param string $phone
     * @return int|null
     */
    public function findCustomer(string $phone): ?int
    {
        $result = $this->execute(self::METHOD_FIND_CUSTOMER, [
            'phone' => $phone,
        ]);

        return $result['customerId'];
    }

    /**
     * @param int $orderId
     * @param string $status
     * @return int
     */
    public function changeOrderStatus(int $orderId, string $status): int
    {
        $result = $this->execute(self::METHOD_CHANGE_ORDER_STATUS, [
            'orderId' => $orderId,
            'status' => $status,
        ]);

        return $result['orderId'];
    }

    /**
     * @param int $id
     * @return int|null
     */
    public function findOrder(int $id): ?int
    {
        $result = $this->execute(self::METHOD_FIND_ORDER, [
            'id' => $id,
        ]);

        return $result['orderId'];
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $status
     * @return array
     */
    public function getOrders(int $limit, int $offset, string $status): array
    {
        return $this->execute(self::METHOD_GET_ORDERS, [
            'limit' => $limit,
            'offset' => $offset,
            'status' => $status,
        ]);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCustomers(int $limit, int $offset): array
    {
        return $this->execute(self::METHOD_GET_CUSTOMERS, [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * @param array $data
     * @return int
     */
    public function createCar(array $data): int
    {
        $result = $this->execute(self::METHOD_CREATE_CAR, $data);

        return $result['carId'];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCar(int $id): array
    {
        $result = $this->execute(self::METHOD_GET_CAR, [
            'id' => $id,
        ]);

        return $result['car'];
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCars(int $limit, int $offset): array
    {
        $result = $this->execute(self::METHOD_GET_CARS, [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $result['data'];
    }

    /**
     * @param string $vin
     * @return int|null
     */
    public function findCar(string $vin): ?int
    {
        $result = $this->execute(self::METHOD_FIND_CAR, [
            'vin' => $vin,
        ]);

        return $result['carId'];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getEmployee(int $id): array
    {
        $result = $this->execute(self::METHOD_GET_EMPLOYEE, [
            'id' => $id,
        ]);

        return $result['employee'];
    }

    /**
     * @param array $data
     * @return int
     */
    public function updateEmployee(array $data): int
    {
        $result = $this->execute(self::METHOD_UPDATE_EMPLOYEE, $data);

        return $result['employeeId'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteEmployee(int $id): int
    {
        $result = $this->execute(self::METHOD_DELETE_EMPLOYEE, [
            'id' => $id,
        ]);

        return $result['employeeId'];
    }

    /**
     * @return array
     */
    public function getResume(): array
    {
        $result = $this->execute(self::METHOD_GET_RESUME);

        return $result['resume'];
    }

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     */
    private function execute(string $method, array $params = [])
    {
        try {
            $request = $this->getRpcClient()->request(Uuid::uuid4()->toString(), $method, $params);
            $result = $this->getRpcClient()->send($request);
        } catch (Throwable $exception) {
            throw new ConnectionException($exception->getMessage());
        }

        if ($result->getRpcErrorCode() === -1000) {
            throw new ValidationException($result->getRpcErrorMessage());
        }

        if ($result->getRpcErrorMessage() !== null) {
            throw new CarServiceException($result->getRpcErrorMessage());
        }

        return $result->getRpcResult();
    }

    /**
     * @return RpcClient
     */
    public function getRpcClient(): RpcClient
    {
        return $this->rpcClient;
    }
}

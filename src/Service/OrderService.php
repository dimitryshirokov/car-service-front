<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Hydrator\HydratorInterface;
use App\Model\OrderShow\Order;

/**
 * Class OrderService
 * @package App\Service
 */
class OrderService implements OrderServiceInterface
{
    /**
     * @var CarServiceClient
     */
    private CarServiceClient $client;

    /**
     * @var HydratorInterface
     */
    private HydratorInterface $hydrator;

    /**
     * OrderService constructor.
     * @param CarServiceClient $client
     * @param HydratorInterface $hydrator
     */
    public function __construct(CarServiceClient $client, HydratorInterface $hydrator)
    {
        $this->client = $client;
        $this->hydrator = $hydrator;
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        return $this->getClient()->getWorksAndEmployers();
    }

    /**
     * @param array $data
     * @return int
     */
    public function createOrder(array $data): int
    {
        return $this->getClient()->createOrder($data);
    }

    /**
     * @param int $orderId
     * @return Order
     */
    public function getOrder(int $orderId): Order
    {
        $orderArray = $this->getClient()->getOrder($orderId);
        $order = new Order();
        $this->getHydrator()->hydrate($orderArray, $order);

        return $order;
    }

    /**
     * @param int $orderId
     * @param string $status
     * @return int
     */
    public function changeStatus(int $orderId, string $status): int
    {
        return $this->getClient()->changeOrderStatus($orderId, $status);
    }

    /**
     * @param int $id
     * @return int|null
     */
    public function find(int $id): ?int
    {
        return $this->getClient()->findOrder($id);
    }

    /**
     * @return CarServiceClient
     */
    public function getClient(): CarServiceClient
    {
        return $this->client;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator(): HydratorInterface
    {
        return $this->hydrator;
    }
}

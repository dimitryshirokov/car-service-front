<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\OrderShow\Order;

/**
 * Interface OrderServiceInterface
 * @package App\Service
 */
interface OrderServiceInterface
{
    /**
     * @return array
     */
    public function getCreateData(): array;

    /**
     * @param array $data
     * @return int
     */
    public function createOrder(array $data): int;

    /**
     * @param int $orderId
     * @return Order
     */
    public function getOrder(int $orderId): Order;

    /**
     * @param int $orderId
     * @param string $status
     * @return int
     */
    public function changeStatus(int $orderId, string $status): int;

    /**
     * @param int $id
     * @return int|null
     */
    public function find(int $id): ?int;
}

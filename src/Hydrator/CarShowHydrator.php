<?php

declare(strict_types=1);

namespace App\Hydrator;

use App\Model\CarShow\Customer;
use App\Model\CarShow\Order;
use DateTime;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CarShowHydrator
 * @package App\Hydrator
 */
class CarShowHydrator implements HydratorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * CarShowHydrator constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param array $from
     * @param object $to
     * @throws ExceptionInterface
     */
    public function hydrate(array $from, object $to): void
    {
        $from['orders'] = $this->hydrateOrders($from['orders']);
        $from['customers'] = $this->hydrateCustomers($from['customers']);
        $this->getSerializer()->denormalize(
            $from,
            get_class($to),
            null,
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $to,
            ]
        );
    }

    /**
     * @param array $ordersArray
     * @return array
     * @throws ExceptionInterface
     * @throws Exception
     */
    private function hydrateOrders(array $ordersArray): array
    {
        $result = [];
        foreach ($ordersArray as $orderArray) {
            $orderArray['created'] = new DateTime($orderArray['created']);
            $order = new Order();
            $this->getSerializer()->denormalize(
                $orderArray,
                Order::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $order,
                ]
            );

            $result[] = $order;
        }

        return $result;
    }

    /**
     * @param array $customersArray
     * @return array
     * @throws ExceptionInterface
     */
    private function hydrateCustomers(array $customersArray): array
    {
        $result = [];
        foreach ($customersArray as $customerArray) {
            $customer = new Customer();
            $this->getSerializer()->denormalize(
                $customerArray,
                Customer::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $customer,
                ]
            );
            $result[] = $customer;
        }

        return $result;
    }

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}

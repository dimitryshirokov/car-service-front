<?php

declare(strict_types=1);

namespace App\Hydrator;

use App\Model\CustomerShow\Car;
use App\Model\CustomerShow\Order;
use DateTime;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CustomerHydrator
 * @package App\Hydrator
 */
class CustomerHydrator implements HydratorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * CustomerHydrator constructor.
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
        $from['cars'] = $this->hydrateCars($from['cars']);
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
            $order = new Order();
            $orderArray['created'] = new DateTime($orderArray['created']);
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
     * @param array $carsArray
     * @return array
     * @throws ExceptionInterface
     */
    private function hydrateCars(array $carsArray): array
    {
        $result = [];
        foreach ($carsArray as $carArray) {
            $car = new Car();
            $this->getSerializer()->denormalize(
                $carArray,
                Car::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $car,
                ]
            );
            $result[] = $car;
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

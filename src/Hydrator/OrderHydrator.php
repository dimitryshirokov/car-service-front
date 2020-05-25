<?php

declare(strict_types=1);

namespace App\Hydrator;

use App\Model\OrderShow\Car;
use App\Model\OrderShow\Customer;
use App\Model\OrderShow\DoneWork;
use App\Model\OrderShow\Order;
use App\Model\OrderShow\Part;
use DateTime;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class OrderHydrator
 * @package App\Hydrator
 */
class OrderHydrator implements HydratorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * OrderHydrator constructor.
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
     * @throws Exception
     */
    public function hydrate(array $from, object $to): void
    {
        $from['created'] = new DateTime($from['created']);
        $from['customer'] = $this->hydrateCustomer($from['customer']);
        $from['car'] = $this->hydrateCar($from['car']);
        $from['doneWorks'] = $this->hydrateDoneWorks($from['doneWorks']);
        $from['parts'] = $this->hydrateParts($from['parts']);

        $this->getSerializer()->denormalize(
            $from,
            Order::class,
            null,
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $to,
            ]
        );
    }

    /**
     * @param array $customerArray
     * @return Customer
     * @throws ExceptionInterface
     */
    private function hydrateCustomer(array $customerArray): Customer
    {
        $customer = new Customer();
        $this->getSerializer()->denormalize(
            $customerArray,
            Customer::class,
            null,
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $customer,
            ]
        );

        return $customer;
    }

    /**
     * @param array $carArray
     * @return Car
     * @throws ExceptionInterface
     */
    private function hydrateCar(array $carArray): Car
    {
        $car = new Car();
        $this->getSerializer()->denormalize(
            $carArray,
            Car::class,
            null,
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $car,
            ]
        );

        return $car;
    }

    /**
     * @param array $doneWorksArray
     * @return array
     * @throws ExceptionInterface
     */
    private function hydrateDoneWorks(array $doneWorksArray): array
    {
        $result = [];
        foreach ($doneWorksArray as $doneWorkArray) {
            $doneWork = new DoneWork();
            $this->getSerializer()->denormalize(
                $doneWorkArray,
                DoneWork::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $doneWork,
                ]
            );

            $result[] = $doneWork;
        }

        return $result;
    }

    /**
     * @param array $partsArray
     * @return array
     * @throws ExceptionInterface
     */
    private function hydrateParts(array $partsArray): array
    {
        $result = [];
        foreach ($partsArray as $partArray) {
            $part = new Part();
            $this->getSerializer()->denormalize(
                $partArray,
                Part::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $part,
                ]
            );

            $result[] = $part;
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

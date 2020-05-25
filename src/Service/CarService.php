<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Extractor\ExtractorInterface;
use App\Hydrator\HydratorInterface;
use App\Model\CarShow\Car as CarShow;
use App\Model\Form\Car;

/**
 * Class CarService
 * @package App\Service
 */
class CarService implements CarServiceInterface
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
     * CarService constructor.
     * @param CarServiceClient $client
     * @param ExtractorInterface $extractor
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        CarServiceClient $client,
        ExtractorInterface $extractor,
        HydratorInterface $hydrator
    ) {
        $this->client = $client;
        $this->extractor = $extractor;
        $this->hydrator = $hydrator;
    }

    /**
     * @param Car $car
     * @return int
     */
    public function create(Car $car): int
    {
        $car = $this->getExtractor()->extract($car);

        return $this->getClient()->createCar($car);
    }

    /**
     * @param int $id
     * @return CarShow
     */
    public function get(int $id): CarShow
    {
        $carShow = new CarShow();
        $car = $this->getClient()->getCar($id);
        $this->getHydrator()->hydrate($car, $carShow);

        return $carShow;
    }

    /**
     * @param string $vin
     * @return int|null
     */
    public function findCar(string $vin): ?int
    {
        return $this->getClient()->findCar($vin);
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

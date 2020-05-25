<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Form\Car;
use App\Model\CarShow\Car as CarShow;

/**
 * Interface CarServiceInterface
 * @package App\Service
 */
interface CarServiceInterface
{
    /**
     * @param Car $car
     * @return int
     */
    public function create(Car $car): int;

    /**
     * @param int $id
     * @return CarShow
     */
    public function get(int $id): CarShow;

    /**
     * @param string $vin
     * @return int|null
     */
    public function findCar(string $vin): ?int;
}

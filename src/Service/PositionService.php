<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Model\Position;

/**
 * Class PositionService
 * @package App\Service
 */
class PositionService implements PositionServiceInterface
{
    /**
     * @var CarServiceClient
     */
    private CarServiceClient $client;

    /**
     * PositionService constructor.
     * @param CarServiceClient $client
     */
    public function __construct(CarServiceClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getPositions(): array
    {
        $positions = $this->getClient()->getPositions();

        $result = [];
        foreach ($positions as $positionArray) {
            $position = new Position();
            $position->setType($positionArray['type'])
                ->setTitle($positionArray['title']);
            $result[] = $position;
        }

        return $result;
    }

    /**
     * @return CarServiceClient
     */
    public function getClient(): CarServiceClient
    {
        return $this->client;
    }
}

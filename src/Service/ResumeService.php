<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Hydrator\HydratorInterface;
use App\Model\ResumeShow\Resume;

/**
 * Class ResumeService
 * @package App\Service
 */
class ResumeService implements ResumeServiceInterface
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
     * ResumeService constructor.
     * @param CarServiceClient $client
     * @param HydratorInterface $hydrator
     */
    public function __construct(CarServiceClient $client, HydratorInterface $hydrator)
    {
        $this->client = $client;
        $this->hydrator = $hydrator;
    }

    /**
     * @return Resume
     */
    public function getResume(): Resume
    {
        $resume = new Resume();
        $data = $this->getClient()->getResume();
        $this->getHydrator()->hydrate($data, $resume);

        return $resume;
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

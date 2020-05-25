<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Extractor\ExtractorInterface;
use App\Model\Work;

/**
 * Class WorkService
 * @package App\Service
 */
class WorkService implements WorkServiceInterface
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
     * WorkService constructor.
     * @param CarServiceClient $client
     * @param ExtractorInterface $extractor
     */
    public function __construct(CarServiceClient $client, ExtractorInterface $extractor)
    {
        $this->client = $client;
        $this->extractor = $extractor;
    }

    /**
     * @param Work $work
     * @return int
     */
    public function create(Work $work): int
    {
        $data = $this->getExtractor()->extract($work);
        return $this->getClient()->createWork($data);
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
}

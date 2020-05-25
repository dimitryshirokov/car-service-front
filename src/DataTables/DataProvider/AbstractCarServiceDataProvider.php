<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\Client\CarServiceClient;

/**
 * Class AbstractCarServiceDataProvider
 * @package App\DataTables\DataProvider
 */
abstract class AbstractCarServiceDataProvider implements DataProviderInterface
{
    /**
     * @var CarServiceClient
     */
    private CarServiceClient $client;

    /**
     * AbstractCarServiceDataProvider constructor.
     * @param CarServiceClient $client
     */
    public function __construct(CarServiceClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return CarServiceClient
     */
    public function getClient(): CarServiceClient
    {
        return $this->client;
    }
}

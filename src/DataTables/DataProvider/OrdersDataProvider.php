<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\Client\CarServiceClient;
use App\DataTables\Model\ResultModel;
use App\DataTables\Model\SelectModel;
use App\Model\OrderShow\Order;
use DateTime;
use Exception;

/**
 * Class OrdersDataProvider
 * @package App\DataTables\DataProvider
 */
class OrdersDataProvider extends AbstractCarServiceDataProvider
{
    /**
     * @var string
     */
    private string $status;

    /**
     * OrdersDataProvider constructor.
     * @param CarServiceClient $client
     * @param string $status
     */
    public function __construct(CarServiceClient $client, string $status)
    {
        parent::__construct($client);
        $this->status = $status;
    }

    /**
     * @param SelectModel $selectModel
     * @return ResultModel
     * @throws Exception
     */
    public function getData(SelectModel $selectModel): ResultModel
    {
        $response = $this->getClient()
            ->getOrders($selectModel->getLimit(), $selectModel->getOffset(), $this->getStatus());

        $result = new ResultModel();
        foreach ($response['data'] as &$datum) {
            $datum['status'] = Order::translateStatus($datum['status']);
            $datum['created'] = (new DateTime($datum['created']))->format('d.m.Y H:i');
            $datum['price'] = number_format((float) $datum['price'], 2) . ' P';
            $datum['totalPrice'] = number_format((float) $datum['totalPrice'], 2) . ' P';
        }
        $result->setData($response['data'])
            ->setCount($response['count'])
            ->setCountFiltered($response['countFiltered']);

        return $result;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}

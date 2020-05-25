<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\DataTables\Model\ResultModel;
use App\DataTables\Model\SelectModel;
use DateTime;
use Exception;

/**
 * Class CustomersDataProvider
 * @package App\DataTables\DataProvider
 */
class CustomersDataProvider extends AbstractCarServiceDataProvider
{

    /**
     * @param SelectModel $selectModel
     * @return ResultModel
     * @throws Exception
     */
    public function getData(SelectModel $selectModel): ResultModel
    {
        $response = $this->getClient()->getCustomers($selectModel->getLimit(), $selectModel->getOffset());

        foreach ($response['data'] as &$datum) {
            $datum['lastOrderDate'] = $datum['lastOrderDate'] === null
                ? null
                : (new DateTime($datum['lastOrderDate']))->format('d.m.Y H:i');
            $datum['discount'] = ((float) $datum['discount'] * 100) . '%';
        }

        $result = new ResultModel();
        $result->setData($response['data'])
            ->setCount($response['count'])
            ->setCountFiltered($response['count']);

        return $result;
    }
}

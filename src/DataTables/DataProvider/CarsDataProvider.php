<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\DataTables\Model\ResultModel;
use App\DataTables\Model\SelectModel;
use Exception;

/**
 * Class CarsDataProvider
 * @package App\DataTables\DataProvider
 */
class CarsDataProvider extends AbstractCarServiceDataProvider
{

    /**
     * @param SelectModel $selectModel
     * @return ResultModel
     * @throws Exception
     */
    public function getData(SelectModel $selectModel): ResultModel
    {
        $response = $this->getClient()->getCars($selectModel->getLimit(), $selectModel->getOffset());
        foreach ($response['data'] as &$datum) {
            $datum['lastOrderDate'] = $datum['lastOrderDate'] === null
                ? null
                : (new \DateTime($datum['lastOrderDate']))->format('d.m.Y H:i');
        }

        $result = new ResultModel();
        $result->setData($response['data'])
            ->setCount($response['count'])
            ->setCountFiltered($response['count']);

        return $result;
    }
}

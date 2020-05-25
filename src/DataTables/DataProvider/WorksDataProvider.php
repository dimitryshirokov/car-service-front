<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\DataTables\Model\ResultModel;
use App\DataTables\Model\SelectModel;

/**
 * Class WorksDataProvider
 * @package App\DataTables\DataProvider
 */
class WorksDataProvider extends AbstractCarServiceDataProvider
{

    /**
     * @param SelectModel $selectModel
     * @return ResultModel
     */
    public function getData(SelectModel $selectModel): ResultModel
    {
        $response = $this->getClient()->getWorks($selectModel->getLimit(), $selectModel->getOffset());
        foreach ($response['result'] as &$value) {
            $value['positions'] = str_replace(',', ', ', $value['positions']);
        }
        $result = new ResultModel();
        $result->setData($response['result'])
            ->setCount($response['count'])
            ->setCountFiltered($response['countFiltered']);

        return $result;
    }
}

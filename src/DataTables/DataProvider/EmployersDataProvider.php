<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\DataTables\Model\ResultModel;
use App\DataTables\Model\SelectModel;

/**
 * Class EmployersDataProvider
 * @package App\DataTables\DataProvider
 */
class EmployersDataProvider extends AbstractCarServiceDataProvider
{
    /**
     * @param SelectModel $selectModel
     * @return ResultModel
     */
    public function getData(SelectModel $selectModel): ResultModel
    {
        $result = new ResultModel();
        $executionResult = $this->getClient()->getEmployers($selectModel->getLimit(), $selectModel->getOffset());

        $result->setData($executionResult['results'])
            ->setCount($executionResult['count'])
            ->setCountFiltered($executionResult['countFiltered']);

        return $result;
    }
}

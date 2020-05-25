<?php

declare(strict_types=1);

namespace App\DataTables\DataProvider;

use App\DataTables\Model\ResultModel;
use App\DataTables\Model\SelectModel;

/**
 * Interface DataProviderInterface
 * @package App\DataTables\DataProvider
 */
interface DataProviderInterface
{
    /**
     * @param SelectModel $selectModel
     * @return ResultModel
     */
    public function getData(SelectModel $selectModel): ResultModel;
}

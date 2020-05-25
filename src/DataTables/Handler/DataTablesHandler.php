<?php

declare(strict_types=1);

namespace App\DataTables\Handler;

use App\DataTables\DataProvider\DataProviderInterface;
use App\DataTables\Model\SelectModel;
use DataTables\DataTableException;
use DataTables\DataTableHandlerInterface;
use DataTables\DataTableQuery;
use DataTables\DataTableResults;

/**
 * Class DataTablesHandler
 * @package App\DataTables\Handler
 */
class DataTablesHandler implements DataTableHandlerInterface
{
    /**
     * @var DataProviderInterface
     */
    private DataProviderInterface $dataProvider;

    /**
     * DataTablesHandler constructor.
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param DataTableQuery $request
     * @return DataTableResults
     */
    public function handle(DataTableQuery $request): DataTableResults
    {
        $selectModel = $this->createSelectModel($request);
        $data = $this->getDataProvider()->getData($selectModel);
        $result = new DataTableResults();
        $result->data = $data->getData();
        $result->recordsFiltered = $data->getCountFiltered();
        $result->recordsTotal = $data->getCount();

        return $result;
    }

    /**
     * @param DataTableQuery $request
     * @return SelectModel
     */
    private function createSelectModel(DataTableQuery $request): SelectModel
    {
        $selectModel = new SelectModel();

        $limit = $request->length;
        $offset = $request->start;

        $selectModel->setLimit($limit)
            ->setOffset($offset);

        return $selectModel;
    }

    /**
     * @return DataProviderInterface
     */
    public function getDataProvider(): DataProviderInterface
    {
        return $this->dataProvider;
    }
}

<?php

declare(strict_types=1);

namespace App\DataTables\Model;

/**
 * Class ResultModel
 * @package App\DataTables\Model
 */
class ResultModel
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @var int
     */
    private int $count;

    /**
     * @var int
     */
    private int $countFiltered;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return ResultModel
     */
    public function setData(array $data): ResultModel
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return ResultModel
     */
    public function setCount(int $count): ResultModel
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountFiltered(): int
    {
        return $this->countFiltered;
    }

    /**
     * @param int $countFiltered
     * @return ResultModel
     */
    public function setCountFiltered(int $countFiltered): ResultModel
    {
        $this->countFiltered = $countFiltered;
        return $this;
    }
}

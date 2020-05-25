<?php

declare(strict_types=1);

namespace App\DataTables\Model;

/**
 * Class SelectModel
 * @package App\DataTables\Model
 */
class SelectModel
{
    /**
     * @var int
     */
    private int $limit;

    /**
     * @var int
     */
    private int $offset;

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return SelectModel
     */
    public function setLimit(int $limit): SelectModel
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return SelectModel
     */
    public function setOffset(int $offset): SelectModel
    {
        $this->offset = $offset;
        return $this;
    }
}

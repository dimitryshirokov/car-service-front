<?php

declare(strict_types=1);

namespace App\Model\ResumeShow;

/**
 * Class Resume
 * @package App\Model\ResumeShow
 */
class Resume
{
    /**
     * @var int
     */
    private int $newOrders;

    /**
     * @var int
     */
    private int $inProgressOrders;

    /**
     * @var int
     */
    private int $customers;

    /**
     * @var int
     */
    private int $employers;

    /**
     * @return int
     */
    public function getNewOrders(): int
    {
        return $this->newOrders;
    }

    /**
     * @param int $newOrders
     * @return Resume
     */
    public function setNewOrders(int $newOrders): Resume
    {
        $this->newOrders = $newOrders;
        return $this;
    }

    /**
     * @return int
     */
    public function getInProgressOrders(): int
    {
        return $this->inProgressOrders;
    }

    /**
     * @param int $inProgressOrders
     * @return Resume
     */
    public function setInProgressOrders(int $inProgressOrders): Resume
    {
        $this->inProgressOrders = $inProgressOrders;
        return $this;
    }

    /**
     * @return int
     */
    public function getCustomers(): int
    {
        return $this->customers;
    }

    /**
     * @param int $customers
     * @return Resume
     */
    public function setCustomers(int $customers): Resume
    {
        $this->customers = $customers;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmployers(): int
    {
        return $this->employers;
    }

    /**
     * @param int $employers
     * @return Resume
     */
    public function setEmployers(int $employers): Resume
    {
        $this->employers = $employers;
        return $this;
    }
}

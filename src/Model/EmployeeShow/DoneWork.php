<?php

declare(strict_types=1);

namespace App\Model\EmployeeShow;

/**
 * Class DoneWork
 * @package App\Model\EmployeeShow
 */
class DoneWork
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var int
     */
    private int $orderId;

    /**
     * @var string
     */
    private string $price;

    /**
     * @var string
     */
    private string $hours;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return DoneWork
     */
    public function setTitle(string $title): DoneWork
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return DoneWork
     */
    public function setOrderId(int $orderId): DoneWork
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return DoneWork
     */
    public function setPrice(string $price): DoneWork
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getHours(): string
    {
        return $this->hours;
    }

    /**
     * @param string $hours
     * @return DoneWork
     */
    public function setHours(string $hours): DoneWork
    {
        $this->hours = $hours;
        return $this;
    }
}

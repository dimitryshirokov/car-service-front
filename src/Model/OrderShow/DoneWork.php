<?php

declare(strict_types=1);

namespace App\Model\OrderShow;

/**
 * Class DoneWork
 * @package App\Model
 */
class DoneWork
{
    /**
     * @var string
     */
    private string $price;

    /**
     * @var string
     */
    private string $work;

    /**
     * @var string
     */
    private string $hours;

    /**
     * @var string
     */
    private string $employers;

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
    public function getWork(): string
    {
        return $this->work;
    }

    /**
     * @param string $work
     * @return DoneWork
     */
    public function setWork(string $work): DoneWork
    {
        $this->work = $work;
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

    /**
     * @return string
     */
    public function getEmployers(): string
    {
        return $this->employers;
    }

    /**
     * @param string $employers
     * @return DoneWork
     */
    public function setEmployers(string $employers): DoneWork
    {
        $this->employers = $employers;
        return $this;
    }
}

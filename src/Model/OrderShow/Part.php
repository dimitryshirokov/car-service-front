<?php

declare(strict_types=1);

namespace App\Model\OrderShow;

/**
 * Class Part
 * @package App\Model
 */
class Part
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $number;

    /**
     * @var string
     */
    private string $cost;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Part
     */
    public function setTitle(string $title): Part
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Part
     */
    public function setNumber(string $number): Part
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     * @return Part
     */
    public function setCost(string $cost): Part
    {
        $this->cost = $cost;
        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\Model\EmployeeShow;

/**
 * Class Work
 * @package App\Model\EmployeeShow
 */
class Work
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $price;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Work
     */
    public function setTitle(string $title): Work
    {
        $this->title = $title;
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
     * @return Work
     */
    public function setPrice(string $price): Work
    {
        $this->price = $price;
        return $this;
    }
}

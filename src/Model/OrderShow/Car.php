<?php

declare(strict_types=1);

namespace App\Model\OrderShow;

/**
 * Class Car
 * @package App\Model
 */
class Car
{
    /**
     * @var string
     */
    private string $manufacturer;

    /**
     * @var string
     */
    private string $model;

    /**
     * @var string
     */
    private string $vin;

    /**
     * @var string
     */
    private string $engine;

    /**
     * @var string
     */
    private string $year;

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     * @return Car
     */
    public function setManufacturer(string $manufacturer): Car
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Car
     */
    public function setModel(string $model): Car
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin(): string
    {
        return $this->vin;
    }

    /**
     * @param string $vin
     * @return Car
     */
    public function setVin(string $vin): Car
    {
        $this->vin = $vin;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngine(): string
    {
        return $this->engine;
    }

    /**
     * @param string $engine
     * @return Car
     */
    public function setEngine(string $engine): Car
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     * @return Car
     */
    public function setYear(string $year): Car
    {
        $this->year = $year;
        return $this;
    }
}

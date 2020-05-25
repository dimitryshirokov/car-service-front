<?php

declare(strict_types=1);

namespace App\Model\CustomerShow;

use DateTime;
use App\Model\OrderShow\Order as OrderShow;

/**
 * Class Order
 * @package App\Model\CustomerShow
 */
class Order
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var DateTime
     */
    private DateTime $created;

    /**
     * @var string
     */
    private string $price;

    /**
     * @var string
     */
    private string $totalPrice;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var string
     */
    private string $vin;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     * @return Order
     */
    public function setCreated(DateTime $created): Order
    {
        $this->created = $created;
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
     * @return Order
     */
    public function setPrice(string $price): Order
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }

    /**
     * @param string $totalPrice
     * @return Order
     */
    public function setTotalPrice(string $totalPrice): Order
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Order
     */
    public function setStatus(string $status): Order
    {
        $this->status = $status;
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
     * @return Order
     */
    public function setVin(string $vin): Order
    {
        $this->vin = $vin;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslatedStatus(): string
    {
        return OrderShow::translateStatus($this->getStatus());
    }
}

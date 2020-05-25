<?php

declare(strict_types=1);

namespace App\Model\OrderShow;

use DateTime;

/**
 * Class Order
 * @package App\Model
 */
class Order
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE = 'done';
    public const STATUS_CANCELLED = 'cancelled';

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
    private string $status;

    /**
     * @var string
     */
    private string $totalPrice;

    /**
     * @var Customer
     */
    private Customer $customer;

    /**
     * @var Car
     */
    private Car $car;

    /**
     * @var DoneWork[]
     */
    private array $doneWorks;

    /**
     * @var Part[]
     */
    private array $parts;

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
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Order
     */
    public function setCustomer(Customer $customer): Order
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->car;
    }

    /**
     * @param Car $car
     * @return Order
     */
    public function setCar(Car $car): Order
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return DoneWork[]
     */
    public function getDoneWorks(): array
    {
        return $this->doneWorks;
    }

    /**
     * @param DoneWork[] $doneWorks
     * @return Order
     */
    public function setDoneWorks(array $doneWorks): Order
    {
        $this->doneWorks = $doneWorks;
        return $this;
    }

    /**
     * @return Part[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }

    /**
     * @param Part[] $parts
     * @return Order
     */
    public function setParts(array $parts): Order
    {
        $this->parts = $parts;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslatedStatus()
    {
        return self::translateStatus($this->getStatus());
    }

    /**
     * @param string $status
     * @return string
     */
    public static function translateStatus(string $status): string
    {
        $map = [
            self::STATUS_NEW => 'Заказ создан',
            self::STATUS_IN_PROGRESS => 'Заказ в работе',
            self::STATUS_CANCELLED => 'Заказ отменён',
            self::STATUS_DONE => 'Заказ выполнен',
        ];

        return $map[$status];
    }
}

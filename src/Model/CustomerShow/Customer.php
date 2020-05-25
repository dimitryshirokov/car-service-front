<?php

declare(strict_types=1);

namespace App\Model\CustomerShow;

/**
 * Class Customer
 * @package App\Model\CustomerShow
 */
class Customer
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $surname;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string|null
     */
    private ?string $patronymic;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $discount;

    /**
     * @var Order[]
     */
    private array $orders;

    /**
     * @var Car[]
     */
    private array $cars;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function setId(int $id): Customer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Customer
     */
    public function setSurname(string $surname): Customer
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @param string|null $patronymic
     * @return Customer
     */
    public function setPatronymic(?string $patronymic): Customer
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Customer
     */
    public function setPhone(string $phone): Customer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscount(): string
    {
        return $this->discount;
    }

    /**
     * @param string $discount
     * @return Customer
     */
    public function setDiscount(string $discount): Customer
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param Order[] $orders
     * @return Customer
     */
    public function setOrders(array $orders): Customer
    {
        $this->orders = $orders;
        return $this;
    }

    /**
     * @return Car[]
     */
    public function getCars(): array
    {
        return $this->cars;
    }

    /**
     * @param Car[] $cars
     * @return Customer
     */
    public function setCars(array $cars): Customer
    {
        $this->cars = $cars;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountInPercents(): string
    {
        return (string) (((float) $this->getDiscount()) * 100);
    }
}

<?php

declare(strict_types=1);

namespace App\Model\CarShow;

/**
 * Class Customer
 * @package App\Model\CarShow
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
     * @return string
     */
    public function getFio(): string
    {
        return trim(sprintf('%s %s %s', $this->getSurname(), $this->getName(), $this->getPatronymic()));
    }

    /**
     * @return string
     */
    public function getDiscountInPercents(): string
    {
        return (string) (((float) $this->getDiscount()) * 100);
    }
}

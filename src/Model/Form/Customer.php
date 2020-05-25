<?php

declare(strict_types=1);

namespace App\Model\Form;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Customer
 * @package App\Model\Form
 */
class Customer
{
    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Пустая фамилия")
     * @Assert\NotBlank(message="Пустая фамилия")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Фамилия не может содержать цифры"
     * )
     */
    private ?string $surname = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Пустое имя")
     * @Assert\NotBlank(message="Пустое имя")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Имя не может содержать цифры"
     * )
     */
    private ?string $name = null;

    /**
     * @var string|null
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Отчество не может содержать цифры"
     * )
     */
    private ?string $patronymic = null;

    /**
     * @var string|null
     * @Assert\Regex(
     *     pattern="/^(\+7)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/",
     *     message="Неправильный формат телефона"
     * )
     */
    private ?string $phone = null;

    /**
     * @var string|null
     */
    private ?string $discount = '0';

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Customer
     */
    public function setId(?int $id): Customer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     * @return Customer
     */
    public function setSurname(?string $surname): Customer
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Customer
     */
    public function setName(?string $name): Customer
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
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Customer
     */
    public function setPhone(?string $phone): Customer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    /**
     * @param string|null $discount
     * @return Customer
     */
    public function setDiscount(?string $discount): Customer
    {
        $this->discount = $discount;
        return $this;
    }
}

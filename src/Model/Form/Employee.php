<?php

declare(strict_types=1);

namespace App\Model;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Employee
 * @package App\Model
 */
class Employee
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
     * @var DateTime|null
     * @Assert\NotNull(message="Не заполнена дата начала работы")
     */
    private ?DateTime $startDate = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Не заполнена должность")
     */
    private ?string $position = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Employee
     */
    public function setId(?int $id): Employee
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
     * @return Employee
     */
    public function setSurname(?string $surname): Employee
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
     * @return Employee
     */
    public function setName(?string $name): Employee
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
     * @return Employee
     */
    public function setPatronymic(?string $patronymic): Employee
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
     * @return Employee
     */
    public function setPhone(?string $phone): Employee
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime|null $startDate
     * @return Employee
     */
    public function setStartDate(?DateTime $startDate): Employee
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string|null $position
     * @return Employee
     */
    public function setPosition(?string $position): Employee
    {
        $this->position = $position;
        return $this;
    }
}

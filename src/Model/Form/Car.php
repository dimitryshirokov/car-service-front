<?php

declare(strict_types=1);

namespace App\Model\Form;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Car
 * @package App\Model\Form
 */
class Car
{
    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Производитель не может быть пустым")
     * @Assert\NotBlank(message="Производитель не может быть пустым")
     * @Assert\Length(
     *     min="1",
     *     max="254",
     *     minMessage="Название производителя должно быть длиннее одного символа",
     *     maxMessage="Название производителя должно быть короче 254 символов"
     * )
     */
    private ?string $manufacturer = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Модель не может быть пустой")
     * @Assert\NotBlank(message="Модель не может быть пустой")
     * @Assert\Length(
     *     min="1",
     *     max="254",
     *     minMessage="Название модели должно быть длиннее одного символа",
     *     maxMessage="Название модели должно быть короче 254 символов"
     * )
     */
    private ?string $model = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Двигатель не может быть пустым")
     * @Assert\NotBlank(message="Двигатель не может быть пустым")
     * @Assert\Length(
     *     min="1",
     *     max="254",
     *     minMessage="Название двигателя должно быть длиннее одного символа",
     *     maxMessage="Название двигателя должно быть короче 254 символов"
     * )
     */
    private ?string $engine = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Год не может быть пустым")
     * @Assert\NotBlank(message="Год не может быть пустым")
     * @Assert\Length(
     *     min="4",
     *     max="4",
     *     minMessage="Год выпуска должен равняться 4 символам",
     *     maxMessage="Год выпуска должен равняться 4 символам",
     *     exactMessage="Год выпуска должен равняться 4 символам"
     * )
     */
    private ?string $year = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="VIN код не может быть пустым")
     * @Assert\NotBlank(message="VIN код не может быть пустым")
     * @Assert\Length(
     *     min="17",
     *     max="17",
     *     minMessage="VIN код должен равняться 17 символам",
     *     maxMessage="VIN код должен равняться 17 символам",
     *     exactMessage="VIN код должен равняться 17 символам"
     * )
     * @Assert\Regex(
     *     pattern="/^[A-Za-z0-9]+$/",
     *     message="VIN код может содержать только цифры и латинские буквы"
     * )
     */
    private ?string $vin = null;

    /**
     * @var string|null
     * @Assert\Regex(
     *     pattern="/^(\+7)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/",
     *     message="Неправильный формат телефона владельца"
     * )
     */
    private ?string $phone = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Car
     */
    public function setId(?int $id): Car
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    /**
     * @param string|null $manufacturer
     * @return Car
     */
    public function setManufacturer(?string $manufacturer): Car
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string|null $model
     * @return Car
     */
    public function setModel(?string $model): Car
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEngine(): ?string
    {
        return $this->engine;
    }

    /**
     * @param string|null $engine
     * @return Car
     */
    public function setEngine(?string $engine): Car
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getYear(): ?string
    {
        return $this->year;
    }

    /**
     * @param string|null $year
     * @return Car
     */
    public function setYear(?string $year): Car
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVin(): ?string
    {
        return $this->vin;
    }

    /**
     * @param string|null $vin
     * @return Car
     */
    public function setVin(?string $vin): Car
    {
        $this->vin = $vin;
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
     * @return Car
     */
    public function setPhone(?string $phone): Car
    {
        $this->phone = $phone;
        return $this;
    }
}

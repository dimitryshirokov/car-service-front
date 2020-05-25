<?php

declare(strict_types=1);

namespace App\Model\EmployeeShow;

use DateTime;

/**
 * Class Employee
 * @package App\Model\EmployeeShow
 */
class Employee
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
     * @var DateTime
     */
    private DateTime $startDate;

    /**
     * @var string
     */
    private string $position;

    /**
     * @var string
     */
    private string $positionType;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var DoneWork[]
     */
    private array $doneWorks;

    /**
     * @var Work[]
     */
    private array $works;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Employee
     */
    public function setId(int $id): Employee
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
     * @return Employee
     */
    public function setSurname(string $surname): Employee
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
     * @return Employee
     */
    public function setName(string $name): Employee
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
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     * @return Employee
     */
    public function setStartDate(DateTime $startDate): Employee
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return Employee
     */
    public function setPosition(string $position): Employee
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string
     */
    public function getPositionType(): string
    {
        return $this->positionType;
    }

    /**
     * @param string $positionType
     * @return Employee
     */
    public function setPositionType(string $positionType): Employee
    {
        $this->positionType = $positionType;
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
     * @return Employee
     */
    public function setPhone(string $phone): Employee
    {
        $this->phone = $phone;
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
     * @return Employee
     */
    public function setDoneWorks(array $doneWorks): Employee
    {
        $this->doneWorks = $doneWorks;
        return $this;
    }

    /**
     * @return Work[]
     */
    public function getWorks(): array
    {
        return $this->works;
    }

    /**
     * @param Work[] $works
     * @return Employee
     */
    public function setWorks(array $works): Employee
    {
        $this->works = $works;
        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Work
 * @package App\Model
 */
class Work
{
    /**
     * @var string|null
     * @Assert\NotNull(message="Пустая работа")
     * @Assert\NotBlank(message="Пустая работа")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Работа не может содержать цифры"
     * )
     */
    private ?string $title = null;

    /**
     * @var string|null
     * @Assert\NotNull(message="Пустая стоимость")
     * @Assert\NotBlank(message="Пустая стоимость")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=true,
     *     message="Стоимость может содержать только цифры"
     * )
     */
    private ?string $price = null;

    /**
     * @var string[]|null
     * @Assert\NotNull(message="Не переданы должности для работы")
     */
    private ?array $positions = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Work
     */
    public function setTitle(?string $title): Work
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     * @return Work
     */
    public function setPrice(?string $price): Work
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getPositions(): ?array
    {
        return $this->positions;
    }

    /**
     * @param string[]|null $positions
     * @return Work
     */
    public function setPositions(?array $positions): Work
    {
        $this->positions = $positions;
        return $this;
    }
}

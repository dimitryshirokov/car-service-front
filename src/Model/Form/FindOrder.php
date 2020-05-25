<?php

declare(strict_types=1);

namespace App\Model\Form;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FindOrder
 * @package App\Model\Form
 */
class FindOrder
{
    /**
     * @var int|null
     * @Assert\NotNull(message="Номер заказа не может быть пустым")
     * @Assert\GreaterThan(value="0", message="Номер заказа не может быть меньше 1")
     */
    private ?int $id = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return FindOrder
     */
    public function setId(?int $id): FindOrder
    {
        $this->id = $id;
        return $this;
    }
}

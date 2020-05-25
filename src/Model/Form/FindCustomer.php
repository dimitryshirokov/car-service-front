<?php

declare(strict_types=1);

namespace App\Model\Form;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FindCustomer
 * @package App\Model\Form
 */
class FindCustomer
{
    /**
     * @var string|null
     * @Assert\Regex(
     *     pattern="/^(\+7)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/",
     *     message="Неправильный формат телефона"
     * )
     */
    private ?string $phone = null;

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return FindCustomer
     */
    public function setPhone(?string $phone): FindCustomer
    {
        $this->phone = $phone;
        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\Model\Form;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FindCar
 * @package App\Model\Form
 */
class FindCar
{
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
     * @return string|null
     */
    public function getVin(): ?string
    {
        return $this->vin;
    }

    /**
     * @param string|null $vin
     * @return FindCar
     */
    public function setVin(?string $vin): FindCar
    {
        $this->vin = $vin;
        return $this;
    }
}

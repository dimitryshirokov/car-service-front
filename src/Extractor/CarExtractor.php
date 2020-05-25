<?php

declare(strict_types=1);

namespace App\Extractor;

use App\Model\Form\Car;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CarExtractor
 * @package App\Extractor
 */
class CarExtractor implements ExtractorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * CarExtractor constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param object|Car $from
     * @return array
     * @throws ExceptionInterface
     */
    public function extract(object $from): array
    {
        return $this->getSerializer()->normalize(
            $from,
            null
        );
    }

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}

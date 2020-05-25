<?php

declare(strict_types=1);

namespace App\Extractor;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CustomerExtractor
 * @package App\Extractor
 */
class CustomerExtractor implements ExtractorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * CustomerExtractor constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param object $from
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

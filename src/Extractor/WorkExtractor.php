<?php

declare(strict_types=1);

namespace App\Extractor;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class WorkExtractor
 * @package App\Extractor
 */
class WorkExtractor implements ExtractorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * WorkExtractor constructor.
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

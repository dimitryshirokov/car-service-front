<?php

declare(strict_types=1);

namespace App\Extractor;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class EmployeeExtractor
 * @package App\Extractor
 */
class EmployeeExtractor implements ExtractorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * EmployeeExtractor constructor.
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
        $result = $this->getSerializer()->normalize($from, null, [
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'
        ]);

        $result['positionType'] = $result['position'];
        unset($result['position']);

        return $result;
    }

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}

<?php

declare(strict_types=1);

namespace App\Hydrator;

use App\Model\EmployeeShow\DoneWork;
use App\Model\EmployeeShow\Employee;
use App\Model\EmployeeShow\Work;
use DateTime;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class EmployeeHydrator
 * @package App\Hydrator
 */
class EmployeeHydrator implements HydratorInterface
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * EmployeeHydrator constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param array $from
     * @param object|Employee $to
     * @throws ExceptionInterface
     */
    public function hydrate(array $from, object $to): void
    {
        $from['startDate'] = new DateTime($from['startDate']);
        $from['doneWorks'] = $this->hydrateDoneWorks($from['doneWorks']);
        $from['works'] = $this->hydrateWorks($from['works']);

        $this->getSerializer()->denormalize(
            $from,
            get_class($to),
            null,
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $to,
            ]
        );
    }

    /**
     * @param array $doneWorks
     * @return array
     * @throws ExceptionInterface
     */
    private function hydrateDoneWorks(array $doneWorks): array
    {
        $result = [];
        foreach ($doneWorks as $doneWorkArray) {
            $doneWork = new DoneWork();
            $this->getSerializer()->denormalize(
                $doneWorkArray,
                DoneWork::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $doneWork,
                ]
            );
            $result[] = $doneWork;
        }

        return $result;
    }

    /**
     * @param array $works
     * @return array
     * @throws ExceptionInterface
     */
    private function hydrateWorks(array $works): array
    {
        $result = [];
        foreach ($works as $workArray) {
            $work = new Work();
            $this->getSerializer()->denormalize(
                $workArray,
                Work::class,
                null,
                [
                    AbstractNormalizer::OBJECT_TO_POPULATE => $work,
                ]
            );
            $result[] = $work;
        }

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

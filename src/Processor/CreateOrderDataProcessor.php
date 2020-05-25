<?php

declare(strict_types=1);

namespace App\Processor;

/**
 * Class CreateOrderDataProcessor
 * @package App\Processor
 */
class CreateOrderDataProcessor implements DataProcessorInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function processData(array $data): array
    {
        $works = json_decode($data['works'], true);
        $works = $this->processWorks($works);
        $parts = json_decode($data['parts'], true);

        return [
            'phone' => $data['phone'],
            'vin' => $data['vin'],
            'works' => $works,
            'parts' => $parts,
        ];
    }

    /**
     * @param array $works
     * @return array
     */
    private function processWorks(array $works): array
    {
        foreach ($works as &$work) {
            $work['id'] = (int) $work['workId'];
            $work['employers'] = $this->processEmployers($work['employers']);
            unset($work['workId']);
            unset($work['totalPrice']);
            unset($work['workDivId']);
        }

        return $works;
    }

    /**
     * @param array $employers
     * @return array
     */
    private function processEmployers(array $employers): array
    {
        foreach ($employers as &$employer) {
            $employer = (int) $employer;
        }

        return $employers;
    }
}

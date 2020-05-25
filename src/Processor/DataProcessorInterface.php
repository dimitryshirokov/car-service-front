<?php

declare(strict_types=1);

namespace App\Processor;

/**
 * Interface DataProcessorInterface
 * @package App\Processor
 */
interface DataProcessorInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function processData(array $data): array;
}

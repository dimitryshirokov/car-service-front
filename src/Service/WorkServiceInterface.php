<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Work;

/**
 * Interface WorkServiceInterface
 * @package App\Service
 */
interface WorkServiceInterface
{
    /**
     * @param Work $work
     * @return int
     */
    public function create(Work $work): int;
}

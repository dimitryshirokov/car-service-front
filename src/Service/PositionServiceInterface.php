<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Position;

/**
 * Interface PositionServiceInterface
 * @package App\Service
 */
interface PositionServiceInterface
{
    /**
     * @return Position[]
     */
    public function getPositions(): array;
}

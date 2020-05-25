<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\ResumeShow\Resume;

/**
 * Interface ResumeServiceInterface
 * @package App\Service
 */
interface ResumeServiceInterface
{
    /**
     * @return Resume
     */
    public function getResume(): Resume;
}

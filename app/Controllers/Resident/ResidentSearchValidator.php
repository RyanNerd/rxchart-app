<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Resident;

class ResidentSearchValidator extends SearchValidatorBase
{
    /**
     * ResidentSearchValidator constructor.
     * @param Resident $resident
     */
    public function __construct(Resident $resident) {
        $this->model = $resident;
    }
}

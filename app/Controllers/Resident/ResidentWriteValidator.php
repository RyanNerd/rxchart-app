<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\WriteValidatorBase;
use Willow\Models\Resident;

class ResidentWriteValidator extends WriteValidatorBase
{
    /**
     * {@inheritdoc}
     */
    protected const MODEL_FIELDS = Resident::FIELDS;
}

<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\WriteValidatorBase;
use Willow\Models\Pillbox;

class PillboxWriteValidator extends WriteValidatorBase
{
    /**
     * {@inheritdoc}
     */
    protected const MODEL_FIELDS = Pillbox::FIELDS;
}

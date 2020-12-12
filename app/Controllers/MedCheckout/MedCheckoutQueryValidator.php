<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Willow\Controllers\QueryValidatorBase;
use Willow\Models\MedCheckout;

class MedCheckoutQueryValidator extends QueryValidatorBase
{
    protected $modelFields = MedCheckout::FIELDS;
}
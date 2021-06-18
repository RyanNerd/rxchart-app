<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\WriteValidatorBase;
use Willow\Models\Medicine;

class MedicineWriteValidator extends WriteValidatorBase
{
    public function __construct(MedicineRules $medicineRules) {
        $this->rules = $medicineRules;
    }

    /**
     * @inheritdoc
     */
    protected const MODEL_FIELDS = Medicine::FIELDS;
}

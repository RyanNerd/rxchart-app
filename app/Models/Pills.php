<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $PillboxId
 * @property integer $MedicineId
 * @property \DateTime $Created
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class Pills extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'PillboxId' => 'integer',
        'MedicineId' => 'integer',
        'Created' => 'datetime',
        'Updated' => 'datetime',

    ];

    protected $table = 'Pills';
}

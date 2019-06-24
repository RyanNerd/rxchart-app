<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property \DateTime $Created
 * @property integer $Id
 * @property integer $MedicineId
 * @property integer $PillboxId
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class Pills extends ModelBase
{
    public const FIELDS = [
        'Created' => 'datetime',
        'Id' => 'integer',
        'MedicineId' => 'integer',
        'PillboxId' => 'integer',
        'Updated' => 'datetime',

    ];

    protected $table = 'Pills';
}

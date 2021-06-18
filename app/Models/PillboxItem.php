<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $UserId
 * @property integer $PillboxId
 * @property integer $ResidentId
 * @property integer $MedicineId
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 * @mixin Builder
 */
class PillboxItem extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'UserId' => 'integer',
        'PillboxId' => 'integer',
        'ResidentId' => 'integer',
        'MedicineId' => 'integer',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'PillboxItem';
}

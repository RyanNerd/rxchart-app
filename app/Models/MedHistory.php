<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $ResidentId
 * @property integer $MedicineId
 * @property string $Notes
 * @property integer $In
 * @property integer $Out
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 *
 * @mixin Builder
 */
class MedHistory extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'ResidentId' => 'integer',
        'MedicineId' => 'integer',
        'UserId' => 'integer',
        'Notes' => 'string',
        'In' => 'integer',
        'Out' => 'integer',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'MedHistory';
}

<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $ResidentId
 * @property integer $MedicineId
 * @property string $Notes
 * @property \DateTime $Created
 * @property \DateTime $Updated
 * @property \DateTime $deleted_at
 *
 * @mixin Builder
 */
class MedHistory extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'ResidentId' => 'integer',
        'MedicineId' => 'integer',
        'Notes' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'MedHistory';
}

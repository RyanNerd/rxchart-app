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

    ];

    protected $table = 'MedHistory';
}

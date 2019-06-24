<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property \DateTime $Created
 * @property integer $Id
 * @property integer $MedicineId
 * @property string $Notes
 * @property integer $ResidentId
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class MedHistory extends ModelBase
{
    public const FIELDS = [
        'Created' => 'datetime',
        'Id' => 'integer',
        'MedicineId' => 'integer',
        'Notes' => 'string',
        'ResidentId' => 'integer',
        'Updated' => 'datetime',

    ];

    protected $table = 'MedHistory';
}

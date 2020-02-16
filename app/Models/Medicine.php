<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $ResidentId
 * @property string $Drug
 * @property string $Strength
 * @property string $Barcode
 * @property string $Directions
 * @property string $Notes
 * @property integer $FillDateDay
 * @property integer $FillDateMonth
 * @property integer $FillDateYear
 * @property \DateTime $Created
 * @property \DateTime $Updated
 * @property \DateTime $deleted_at
 *
 * @mixin Builder
 */
class Medicine extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'ResidentId' => 'integer',
        'UserId' => 'integer',
        'Drug' => 'string',
        'Strength' => 'string',
        'Barcode' => 'string',
        'Directions' => 'string',
        'Notes' => 'string',
        'FillDateMonth' => 'string',
        'FillDateDay' => 'string',
        'FillDateYear' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'Medicine';
}

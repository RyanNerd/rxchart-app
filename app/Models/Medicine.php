<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $Barcode
 * @property \DateTime $Created
 * @property string $Directions
 * @property integer $Id
 * @property string $MedicineName
 * @property string $Notes
 * @property integer $ResidentId
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class Medicine extends ModelBase
{
    public const FIELDS = [
        'Barcode' => 'string',
        'Created' => 'datetime',
        'Directions' => 'string',
        'Id' => 'integer',
        'MedicineName' => 'string',
        'Notes' => 'string',
        'ResidentId' => 'integer',
        'Updated' => 'datetime',

    ];

    protected $table = 'Medicine';
}

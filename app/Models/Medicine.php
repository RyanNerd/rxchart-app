<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $ResidentId
 * @property string $Drug
 * @property string $Barcode
 * @property string $Directions
 * @property string $Notes
 * @property \DateTime $Created
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class Medicine extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'ResidentId' => 'integer',
        'Drug' => 'string',
        'Barcode' => 'string',
        'Directions' => 'string',
        'Notes' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',

    ];

    protected $table = 'Medicine';
}

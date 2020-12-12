<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $UserId
 * @property integer $MedicineId
 * @property boolean $Out
 * @property boolean $In
 * @property \DateTime $Created
 * @property \DateTime $MedCheckoutcol
 * @property \DateTime $deleted_at
 *
 * @mixin Builder
 */
class MedCheckout extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'UserId' => 'integer',
        'MedicineId' => 'integer',
        'Out' => 'boolean',
        'In' => 'boolean',
        'Created' => 'datetime',
        'MedCheckoutcol' => 'datetime',
        'deleted_at' => 'datetime',

    ];

    protected $table = 'MedCheckout';
}

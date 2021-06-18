<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $UserId
 * @property integer $ResidentId
 * @property integer $MedicineId
 * @property string $Description
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 * @mixin Builder
 */
class Pillbox extends ModelBase
{
    /**
     * {@inheritdoc}
     */
    public const FIELDS = [
        'Id' => 'integer',
        'UserId' => 'integer',
        'ResidentId' => 'integer',
        'MedicineId' => 'integer',
        'Description' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'Pillbox';

    /**
     * Override Notes to null if empty string
     * @param string|null $value
     */
    final public function setDescriptionAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['Description'] = null;
        } else {
            $this->attributes['Description'] = $value;
        }
    }
}

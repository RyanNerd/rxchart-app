<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
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
 * @property boolean $OTC
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
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
        'FillDateMonth' => 'tinyint',
        'FillDateDay' => 'tinyint',
        'FillDateYear' => 'integer',
        'OTC' => 'boolean',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'Medicine';

    /**
     * Override Strength field to null if empty string
     * @param string|null $value
     */
    public function setStrengthAttribute(?string $value)
    {
        if (empty($value)) {
            $this->attributes['Strength'] = null;
        } else {
            $this->attributes['Strength'] = $value;
        }
    }

    /**
     * Override Barcode field to null if empty string
     * @param string|null $value
     */
    public function setBarcodeAttribute(?string $value)
    {
        if (empty($value)) {
            $this->attributes['Barcode'] = null;
        } else {
            $this->attributes['Barcode'] = $value;
        }
    }

    /**
     * Override Directions field to null if empty string
     * @param string|null $value
     */
    public function setDirectionsAttribute(?string $value)
    {
        if (empty($value)) {
            $this->attributes['Directions'] = null;
        } else {
            $this->attributes['Directions'] = $value;
        }
    }

    /**
     * Override FillDateMonth field to null if empty string
     * @param string|null $value
     */
    public function setFillDateMonthAttribute(?string $value) {
        if (empty($value)) {
            $this->attributes['FillDateMonth'] = null;
        } else {
            $this->attributes['FillDateMonth'] = (int)$value;
        }
    }

    /**
     * Override FillDateDay field to null if empty string
     * @param string|null $value
     */
    public function setFillDateDayAttribute(?string $value) {
        if (empty($value)) {
            $this->attributes['FillDateDay'] = null;
        } else {
            $this->attributes['FillDateDay'] = (int)$value;
        }
    }

    /**
     * Override FillDateYear field to null if empty string
     * @param string|null $value
     */
    public function setFillDateYearAttribute(?string $value) {
        if (empty($value)) {
            $this->attributes['FillDateYear'] = null;
        } else {
            $this->attributes['FillDateYear'] = (int)$value;
        }
    }
}

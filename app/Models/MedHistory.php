<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRule::class)]
#[ApplyModelRule(MedHistoryModelRule::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('ResidentId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('MedicineId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('Notes', 'string', 500)]
#[ApplyModelColumnAttribute('In', 'tinyint', null, null, 'NULL')]
#[ApplyModelColumnAttribute('Out', 'tinyint', null, null, 'NULL')]
#[ApplyModelColumnAttribute('Created', 'DateTime', null, null, 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, null, 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, null, 'NULL')]
/**
 * @property integer $Id
 * @property integer $ResidentId
 * @property integer $MedicineId
 * @property integer $UserId
 * @property string $Notes
 * @property integer $In
 * @property integer $Out
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class MedHistory extends ModelBase
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Override Notes to null if empty string
     * @param string|null $value
     */
    final public function setNotesAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['Notes'] = null;
        } else {
            $this->attributes['Notes'] = $value;
        }
    }
}

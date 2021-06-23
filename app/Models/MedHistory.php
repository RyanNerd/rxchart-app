<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelRule(MedHistoryModelRule::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('ResidentId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('MedicineId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]
#[ApplyModelColumnAttribute('Notes', 'string', 500)]
#[ApplyModelColumnAttribute('In', 'int', 254, null, 'NULL')]
#[ApplyModelColumnAttribute('Out', 'int', 254, null, 'NULL')]
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // PK
 * @property integer $ResidentId    // Resident FK
 * @property integer $MedicineId    // Medicine FK
 * @property integer $UserId        // User FK
 * @property string $Notes          // Amount taken or detials about the drug taken
 * @property integer $In            // Number of pills returned
 * @property integer $Out           // Number of pills taken out
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class MedHistory extends ModelBase
{
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

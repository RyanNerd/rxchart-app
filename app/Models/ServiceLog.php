<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('ResidentId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('ServiceId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]
#[ApplyModelColumnAttribute('HmisId', 'string', 15)]
#[ApplyModelColumnAttribute('Notes', 'string', 150, null, 'NULL')]
#[ApplyModelColumnAttribute('Recorded', 'DateTime', null, [], 'NULL')]
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // PK
 * @property integer $ResidentId    // Resident FK
 * @property integer $ServiceId     // Service FK
 * @property integer $UserId        // User FK
 * @property string  $HmisId        // HMIS #
 * @property string  $Notes         // Notes
 * @property DateTime $Recorded     // Date imported into HMIS
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class ServiceLog extends ModelBase
{
    protected $table = 'ServiceLog';

    /**
     * Override HmisId to null if empty string
     * @param string|null $value
     */
    final public function setHmisIdAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['HmisId'] = null;
        } else {
            $this->attributes['HmisId'] = $value;
        }
    }
}

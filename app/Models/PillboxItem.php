<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('ResidentId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('PillboxId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('MedicineId', 'int', null, ['NN'])]
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]
#[ApplyModelColumnAttribute('Quantity', 'int', 254, null, 'NULL')]
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // PK
 * @property integer $ResidentId    // Resident FK
 * @property integer $PillboxId     // Pillbox FK
 * @property integer $MedicineId    // Medicine FK
 * @property integer $UserId        // User FK
 * @property integer $Quantity      // Number of pills or doses
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class PillboxItem extends ModelBase
{
    protected $table = 'PillboxItem';
}

<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]         // Service PK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN', 'CE'])]           // User FK
#[ApplyModelColumnAttribute('HmisId', 'int', null, ['NN'])]                 // HMIS #
#[ApplyModelColumnAttribute('ServiceName', 'string', 100, ['NN'])]          // Service Name
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // Service PK
 * @property integer $UserId        // User FK
 * @property integer $HmisId        // HMIS #
 * @property string $ServiceName    // Service name
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Service extends ModelBase
{
    protected $table = 'Service';
}

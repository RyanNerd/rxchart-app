<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]         // Service PK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN', 'CE'])]           // User FK
#[ApplyModelColumnAttribute('HmisId', 'string', 15)]                        // HMIS #
#[ApplyModelColumnAttribute('ServiceName', 'string', 100, ['NN'])]          // Service Name
#[ApplyModelColumnAttribute('AllowMultiple', 'boolean', null, ['NN'])]      // Allow multiple services for the same day
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // Service PK
 * @property integer $UserId        // User FK
 * @property string $HmisId         // HMIS #
 * @property string $ServiceName    // Service name
 * @property boolean $AllowMultiple // Allow multiple services for the same day
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Service extends ModelBase
{
    protected $table = 'Service';

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

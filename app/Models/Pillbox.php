<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])] // Medicine PK
#[ApplyModelColumnAttribute('ResidentId', 'int', null)]             // Resident FK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]    // User FK
#[ApplyModelColumnAttribute('Name', 'string', 45, ['NN'])]         // Medicine Name
#[ApplyModelColumnAttribute('Notes', 'string', 500)]                // Additional information about the drug
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id                // Medicine PK
 * @property integer $ResidentId        // Resident FK
 * @property integer $UserId            // User FK
 * @property string $Name               // Pillbox name
 * @property string $Notes              // Additional information about the pillbox
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Pillbox extends ModelBase
{
    protected $table = 'Pillbox';

    /**
     * Override Notes field to null if empty string
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

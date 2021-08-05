<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])] // Medicine PK
#[ApplyModelColumnAttribute('ResidentId', 'int', null)]             // Resident FK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]    // User FK
#[ApplyModelColumnAttribute('MedicineId', 'int', null)]             // Pillbox parent self referencing FK
#[ApplyModelColumnAttribute('Drug', 'string', 100, ['NN'])]         // Medicine Name
#[ApplyModelColumnAttribute('OtherNames', 'string', 100)]           // Other names for the medicine
#[ApplyModelColumnAttribute('Strength', 'string', 20)]              // Medicine strength e.g. '20mg'
#[ApplyModelColumnAttribute('Barcode', 'string', 150)]              // Barcode
#[ApplyModelColumnAttribute('Directions', 'string', 300)]           // Directions e.g. 'Take one tablet by mouth daily'
#[ApplyModelColumnAttribute('Notes', 'string', 500)]                // Additional information about the drug
#[ApplyModelColumnAttribute('FillDateDay', 'int')]                  // Day value for when the drug was filled mm/DD/yyyy
#[ApplyModelColumnAttribute('FillDateMonth', 'int')]                // Month value when the drug was filled MM/dd/yyyy
#[ApplyModelColumnAttribute('FillDateYear', 'int')]                 // Year value when the drug was filled mm/dd/YYYY
#[ApplyModelColumnAttribute('OTC', 'bool', null, null, '0')]        // Is set to true (1) if drug is OTC
#[ApplyModelColumnAttribute('Pillbox', 'bool', null, null, '0')]    // Is set to true (1) if parent Pillbox record
#[ApplyModelColumnAttribute('Quantity', 'int', 254)]                // For Pillbox items (child Medicine records)
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id                // Medicine PK
 * @property integer $ResidentId        // Resident FK
 * @property integer $UserId            // User FK
 * @property integer $MedicineId        // Pillbox self referening FK
 * @property string $Drug               // Medicine name
 * @property string $Strength           // Medicine strength e.g. 10mg
 * @property string $Barcode            // Barcode
 * @property string $Directions         // Directions e.g. Take one tablet at bedtime
 * @property string $Notes              // Additional information about the drug
 * @property integer $FillDateDay       // Day value for when the drug was filled mm/DD/yyyy
 * @property integer $FillDateMonth     // Month value when the drug was filled MM/dd/yyyy
 * @property integer $FillDateYear      // Year value when the drug was filled mm/dd/YYYY
 * @property boolean $OTC               // Is set to true (1) if drug is OTC
 * @property boolean $Pillbox           // Is set to true (1) if parent Pillbox record
 * @property integer $Quantity          // For Pillbox items (child Medicine records)
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Medicine extends ModelBase
{
    protected $table = 'Medicine';

    /**
     * Override Strength field to null if empty string
     * @param string|null $value
     */
    final public function setStrengthAttribute(?string $value): void {
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
    final public function setBarcodeAttribute(?string $value): void {
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
    final public function setDirectionsAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['Directions'] = null;
        } else {
            $this->attributes['Directions'] = $value;
        }
    }

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

    /**
     * Override FillDateMonth field to null if empty string
     * @param string|null $value
     */
    final public function setFillDateMonthAttribute(?string $value): void {
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
    final public function setFillDateDayAttribute(?string $value): void {
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
    final public function setFillDateYearAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['FillDateYear'] = null;
        } else {
            $this->attributes['FillDateYear'] = (int)$value;
        }
    }
}

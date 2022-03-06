<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

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
class PillboxItemRepresentation
{
    public int $Id;
    public int $ResidentId;
    public int $PillboxId;
    public int $MedicineId;
    public int $UserId;
    public int $Quantity;
    public DateTime $Created;
    public DateTime $Updated;
    public DateTime $deleted_at;
}

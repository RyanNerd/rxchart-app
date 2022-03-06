<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

class MedHistoryRepresentation
{
    public int $Id;               // Primary Key
    public int $ResidentId;       // Resident FK
    public int $MedicineId;       // Medicine FK
    public int $PillboxItemId;    // PillboxItem FK
    public int $UserId;           // User FK
    public string $Notes;         // Amount taken or details about the drug taken
    public int $In;               // Number of pills returned
    public int $Out;              // Number of pills taken out
    public DateTime $Created;
    public DateTime $Updated;
    public DateTime $deleted_at;
}

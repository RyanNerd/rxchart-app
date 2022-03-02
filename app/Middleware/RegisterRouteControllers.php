<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Slim\Routing\RouteCollectorProxy;
use Willow\Controllers\Authenticate\AuthenticateController;
use Willow\Controllers\MedHistory\MedHistoryController;
use Willow\Controllers\Medicine\MedicineController;
use Willow\Controllers\Pillbox\PillboxController;
use Willow\Controllers\PillboxItem\PillboxItemController;
use Willow\Controllers\Pin\PinController;
use Willow\Controllers\Resident\ResidentController;
use Willow\Controllers\File\FileController;

class RegisterRouteControllers
{
    public function __construct(
        private AuthenticateController $authenticateController,
        private FileController         $fileController,
        private MedHistoryController   $medHistoryController,
        private MedicineController     $medicineController,
        private PillboxController      $pillboxController,
        private PillboxItemController  $pillboxItemController,
        private PinController          $pinController,
        private ResidentController     $residentController
    ) {
    }

    public function __invoke(RouteCollectorProxy $collectorProxy): self {
        // Register routes and actions for each controller
        $this->authenticateController->register($collectorProxy);
        $this->fileController->register($collectorProxy);
        $this->medHistoryController->register($collectorProxy);
        $this->medicineController->register($collectorProxy);
        $this->pillboxController->register($collectorProxy);
        $this->pillboxItemController->register($collectorProxy);
        $this->pinController->register($collectorProxy);
        $this->residentController->register($collectorProxy);
        return $this;
    }
}

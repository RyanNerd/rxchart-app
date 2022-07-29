<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Slim\Routing\RouteCollectorProxy;
use Willow\Controllers\Authenticate\AuthenticateController;
use Willow\Controllers\File\FileController;
use Willow\Controllers\HmisUsers\HmisUsersController;
use Willow\Controllers\MedHistory\MedHistoryController;
use Willow\Controllers\Medicine\MedicineController;
use Willow\Controllers\Pillbox\PillboxController;
use Willow\Controllers\PillboxItem\PillboxItemController;
use Willow\Controllers\Pin\PinController;
use Willow\Controllers\Resident\ResidentController;
use Willow\Controllers\Service\ServiceController;
use Willow\Controllers\ServiceLog\ServiceLogController;


class RegisterRouteControllers
{
    public function __construct(
        private AuthenticateController $authenticateController,
        private FileController         $fileController,
        private HmisUsersController    $hmisUsersController,
        private MedHistoryController   $medHistoryController,
        private MedicineController     $medicineController,
        private PillboxController      $pillboxController,
        private PillboxItemController  $pillboxItemController,
        private PinController          $pinController,
        private ResidentController     $residentController,
        private ServiceController      $serviceController,
        private ServiceLogController $serviceLogController
    ) {
    }

    public function __invoke(RouteCollectorProxy $collectorProxy): self {
        // Register routes and actions for each controller
        $this->authenticateController->register($collectorProxy);
        $this->fileController->register($collectorProxy);
        $this->hmisUsersController->register($collectorProxy);
        $this->medHistoryController->register($collectorProxy);
        $this->medicineController->register($collectorProxy);
        $this->pillboxController->register($collectorProxy);
        $this->pillboxItemController->register($collectorProxy);
        $this->pinController->register($collectorProxy);
        $this->residentController->register($collectorProxy);
        $this->serviceController->register($collectorProxy);
        $this->serviceLogController->register($collectorProxy);
        return $this;
    }
}

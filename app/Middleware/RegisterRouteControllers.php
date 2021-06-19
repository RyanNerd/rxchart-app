<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Slim\Routing\RouteCollectorProxy;
use Willow\Controllers\Authenticate\AuthenticateController;
use Willow\Controllers\MedHistory\MedHistoryController;
use Willow\Controllers\Medicine\MedicineController;
use Willow\Controllers\Resident\ResidentController;

class RegisterRouteControllers
{
    public function __construct(
        private AuthenticateController $authenticateController,
        private MedHistoryController $medHistoryController,
        private MedicineController $medicineController,
        private ResidentController $residentController
    ) {
    }

    public function __invoke(RouteCollectorProxy $collectorProxy): self {
        // Register routes and actions for each controller
        $this->authenticateController->register($collectorProxy);
        $this->medHistoryController->register($collectorProxy);
        $this->medicineController->register($collectorProxy);
        $this->residentController->register($collectorProxy);
        return $this;
    }
}

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
    protected AuthenticateController $authenticateController;
    protected MedHistoryController $medHistoryController;
    protected MedicineController $medicineController;
    protected ResidentController $residentController;

    public function __construct(
        AuthenticateController $authenticateController,
        MedHistoryController $medHistoryController,
        MedicineController $medicineController,
        ResidentController $residentController
    )
    {
        $this->authenticateController = $authenticateController;
        $this->medHistoryController = $medHistoryController;
        $this->medicineController = $medicineController;
        $this->residentController = $residentController;
    }

    public function __invoke(RouteCollectorProxy $collectorProxy): self
    {
        // Register routes and actions for each controller
        $this->authenticateController->register($collectorProxy);
        $this->medHistoryController->register($collectorProxy);
        $this->medicineController->register($collectorProxy);
        $this->residentController->register($collectorProxy);
        return $this;
    }
}

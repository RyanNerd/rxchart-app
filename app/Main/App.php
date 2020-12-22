<?php
declare(strict_types=1);

namespace Willow\Main;

use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Willow\Controllers\Authenticate\AuthenticateController;
use Willow\Controllers\MedCheckout\MedCheckoutController;
use Willow\Controllers\MedHistory\MedHistoryController;
use Willow\Controllers\Medicine\MedicineController;
use Willow\Controllers\PasswordReset\PasswordResetController;
use Willow\Controllers\Resident\ResidentController;
use Willow\Middleware\JsonBodyParser;
use Willow\Middleware\ResponseBodyFactory;
use Willow\Middleware\ValidateRequest;

class App
{
    /**
     * @var Capsule|null
     */
    protected static $capsule;

    /**
     * @var ContainerInterface|null
     */
    protected static $container;

    /**
     * App constructor.
     * @param bool $run
     * @throws DependencyException
     * @throws NotFoundException
     * @throws Exception
     */
    public function __construct(bool $run = true)
    {
        // Set up Dependency Injection
        $builder = new ContainerBuilder();
        foreach (glob(__DIR__ . '/../../config/*.php') as $definitions) {
            // Skip the _env.php file for the definitions as this was required already in public/index.php
            if (strpos($definitions, '_env.php') === false) {
                $builder->addDefinitions(realpath($definitions));
            }
        }
        $container = $builder->build();
        self::$container = $container;

        // Establish an instance of the Illuminate database capsule (if not already established)
        if (self::$capsule === null) {
            self::$capsule = $container->get(Capsule::class);
        }

        // Get an instance of Slim\App
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        $app->addRoutingMiddleware();

        // Register the routes via the controllers
        $v1 = $app->group('/v1', function (RouteCollectorProxy $collectorProxy) use ($container) {
            // Register controllers/routes
            $container->get(AuthenticateController::class)->register($collectorProxy);
            $container->get(MedHistoryController::class)->register($collectorProxy);
            $container->get(MedicineController::class)->register($collectorProxy);
            $container->get(PasswordResetController::class)->register($collectorProxy);
            $container->get(ResidentController::class)->register($collectorProxy);
            $container->get(MedCheckoutController::class)->register($collectorProxy);
        });

        // Add middleware that validates the overall request.
        $v1->add(ValidateRequest::class);

        // Add ResponseBody as a Request attribute
        $v1->add(ResponseBodyFactory::class);

        // Add JSON parser middleware
        $app->add(JsonBodyParser::class);

        // Add Error Middleware
        $displayErrorDetails = getenv('DISPLAY_ERROR_DETAILS') === 'true';
        $app->addErrorMiddleware($displayErrorDetails, true, true);

        // Run will be true unless we are doing a unit test.
        if ($run) {
            $app->run();
        }
    }

    static function getContainer(): ?ContainerInterface
    {
        return self::$container;
    }

    static function getCapsule(): ?Capsule
    {
        return self::$capsule;
    }
}

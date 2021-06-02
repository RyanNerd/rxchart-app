<?php
declare(strict_types=1);

namespace Willow\Main;

use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

use Slim\Factory\AppFactory;
use Willow\Middleware\RegisterRouteControllers;
use Willow\Middleware\ResponseBodyFactory;
use Willow\Middleware\ValidateRequest;

class App
{
    protected static Capsule $capsule;

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
            if (!str_contains($definitions, '_env.php')) {
                $builder->addDefinitions(realpath($definitions));
            }
        }

        // Get an instance of Slim\App
        AppFactory::setContainer($builder->build());
        $app = AppFactory::create();

        // Add all the needed middleware
        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware(
            getenv('DISPLAY_ERROR_DETAILS') === 'true',
            true,
            true
        );

        // Establish an instance of the Illuminate database capsule
        self::$capsule = $app->getContainer()->get(Capsule::class);

        // Register the v1 group and add the middleware to the group.
        $app->group('/v1', RegisterRouteControllers::class)
            ->add(ValidateRequest::class) // Add middleware that validates the overall request.
            ->add(ResponseBodyFactory::class); // Add ResponseBody as a Request attribute

        // Run will be true unless we are doing a unit test.
        if ($run) {
            $app->run();
        }
    }
}

<?php
declare(strict_types=1);

namespace Willow\Main;

use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Willow\Controllers\ApiValidator;
use Willow\Middleware\RegisterRouteControllers;
use Willow\Middleware\ResponseBodyFactory;
use Willow\Middleware\ValidateRequest;

class App
{
    /**
     * App constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        // Get an instance of Slim\App
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Add all the needed middleware
        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware(
            $container->get('ENV')['DISPLAY_ERROR_DETAILS'] === 'true',
            true,
            true
        );

        // Register the v1 group and add the middleware to the group.
        $app->group('/v1', RegisterRouteControllers::class)
            ->add(ApiValidator::class)
            ->add(ValidateRequest::class) // Add middleware that validates the overall request.
            ->add(ResponseBodyFactory::class); // Add ResponseBody as a Request attribute

        $app->run();
    }
}

<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use League\CLImate\CLImate;
use Willow\Main\App;

require __DIR__ . '/../vendor/autoload.php';

try {
    // We're always handling CORS so we check the request method up front for OPTIONS and short circuit Slim
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Is this a pre-flight request (the request method is OPTIONS)? Then start output buffering.
    if ($requestMethod === 'OPTIONS') {
        ob_start();
    }

    // Allow for all origins and credentials. Also allow GET, POST, PATCH, OPTIONS, and DELETE request verbs
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, OPTIONS, DELETE');

    // If this is a pre-flight request (the request method is OPTIONS)? Then flush the output buffer and exit.
    if ($requestMethod === 'OPTIONS') {
        ob_end_flush();
        exit();
    }

    // Establish DI
    $builder = new ContainerBuilder();
    $builder
        ->addDefinitions(__DIR__ . '/../config/_env.php')
        ->addDefinitions(__DIR__ . '/../config/db.php');
    $container = $builder->build();

    // Instantiate the Eloquent ORM
    $container->get('Eloquent');

    // Launch the App
    new App($container);
} catch (Throwable $throwable) {
    // See: https://github.com/krakjoe/pthreads/issues/806
    if (!defined('STDOUT')) {
        define('STDOUT', fopen('php://stdout', 'wb'));
    }

    if (!defined('STDERR')) {
        define('STDERR', fopen('php://stderr', 'wb'));
    }

    $cli = new CLImate();
    $cli->br(2);
    $cli->backgroundLightYellow()->red()->border('*', 79);
    $cli->backgroundLightYellow()->red()->inline('Message: ')->white($throwable->getMessage());
    $cli->backgroundLightYellow()->red()->inline('File: ')->white($throwable->getFile());
    $cli->backgroundLightYellow()->red()->inline('Line: ')->white((string)$throwable->getLine());
    $cli->backgroundLightYellow()->red()->border('*', 79);
    $cli->br(2);
    exit();
}

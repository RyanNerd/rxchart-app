<?php
declare(strict_types=1);

// This is the entry point for the app and is where we should load all the dependencies
use DI\ContainerBuilder;
use Dotenv\Dotenv;
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
    // phpcs:ignore -- ignore a really long valid header string
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, OPTIONS, DELETE');

    // If this is a pre-flight request (the request method is OPTIONS)? Then flush the output buffer and exit.
    if ($requestMethod === 'OPTIONS') {
        ob_end_flush();
        exit();
    }

    // Load and validate the .env file
    $dotEnv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotEnv->load();
    $dotEnv->required([
        'DB_HOST',
        'DB_PORT',
        'DB_NAME',
        'DB_USER',
        'DB_PASSWORD',
        'DISPLAY_ERROR_DETAILS'
    ])->notEmpty();
    $dotEnv->required('DISPLAY_ERROR_DETAILS')->allowedValues(['true', 'false']);
    $dotEnv->ifPresent('API_OVERRIDE')->notEmpty();

    // Establish DI
    $builder = new ContainerBuilder();
    $builder->addDefinitions(__DIR__ . '/../config/db.php');
    $container = $builder->build();

    // Instantiate the Eloquent ORM
    $container->get('Eloquent');

    // Launch the App
    new App($container);
} catch (Throwable $throwable) {
    echo '********** ERROR **********' . PHP_EOL;
    echo 'Message: ' . $throwable->getMessage() . PHP_EOL;
    echo 'File:' . $throwable->getFile() . PHP_EOL;
    echo 'Line:' . $throwable->getLine();
    echo '********** ERROR **********' . PHP_EOL . PHP_EOL;
    exit();
}

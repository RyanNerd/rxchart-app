<?php
declare(strict_types=1);

// This is the entry point for the app and is where we load all the dependencies
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Willow\Main\App;

require __DIR__ . '/../vendor/autoload.php';

try {
    // We're always handling CORS, so we check the request method up front for OPTIONS and short circuit Slim
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Is this a pre-flight request (the request method is OPTIONS)? Then start output buffering.
    if ($requestMethod === 'OPTIONS') {
        ob_start();
    }

    // Allow for all origins and credentials. Also allow GET, POST, OPTIONS, and DELETE request verbs
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    // phpcs:ignore -- ignore a really long valid header string
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE');

    // If this is a pre-flight request (the request method is OPTIONS) then flush the output buffer and exit.
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
    ob_start();
    header('Content-Type: text/html; charset=UTF-8');
    http_response_code(500);
    if ($_ENV['DISPLAY_ERROR_DETAILS'] ?? '' === 'true') {
        $message = $throwable->getMessage();
        $file = $throwable->getFile();
        $line = $throwable->getLine();
        echo <<<EOS
        ********** ERROR **********</br>
        Message: $message</br>
        File:' $file </br>
        Line:' $line </br>
        ********** ERROR **********</br>
EOS;
    } else {
        echo 'An error occurred. Check the server log for details.';
    }
    ob_end_flush();
    exit();
}

<?php
declare(strict_types=1);

use Willow\Main\App;

require __DIR__ . '/../vendor/autoload.php';

// Does the .env file exist?
if (file_exists(__DIR__ . '/../.env')) {
    // Set the environment variables from the .env file
    require_once __DIR__ . '/../config/_env.php';

    // Is Willow handling CORS?
    if (getenv('CORS') === 'true') {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Is this a pre-flight request (the request method is OPTIONS)? Then start output buffering.
        if ($requestMethod === 'OPTIONS') {
            ob_start();
        }

        // Allow for all origins and credentials. Also allow GET, POST, PATCH, and OPTIONS request verbs
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, OPTIONS, DELETE');

        // If this is a pre-flight request (the request method is OPTIONS)? Then flush the output buffer and exit.
        if ($requestMethod === 'OPTIONS') {
            ob_end_flush();
            exit();
        }
    }
} else {
    // Output to STDERR that the .env file is missing.
    $stdErr = fopen('php://stderr', 'b');
    fwrite($stdErr, 'WARNING: The .env file is missing' . PHP_EOL);
    fclose($stdErr);
    ob_start();
    echo 'The .env file is missing';
    ob_end_flush();
    exit();
}

// Launch the app
try {
    new App();
} catch (Throwable $throwable) {
    // Output to STDERR the exception error message.
    $stdErr = fopen('php://stderr', 'b');
    fwrite($stdErr, $throwable->getMessage() . PHP_EOL);
    fclose($stdErr);

    ob_start();
    echo 'Message: ' . $throwable->getMessage() . ' --- ';
    echo 'File: ' . $throwable->getFile() . ' --- ';
    echo 'Line: ' . $throwable->getLine();
    ob_end_flush();
    exit();
}

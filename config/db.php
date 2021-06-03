<?php
declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager;

return [
    'Eloquent' => function(ContainerInterface $c) {
        $eloquent = new Manager;

        $eloquent->addConnection([
            'driver'    => 'mysql',
            'host'      => $c->get('ENV')['DB_HOST'],
            'port'      => $c->get('ENV')['DB_PORT'],
            'database'  => $c->get('ENV')['DB_NAME'],
            'username'  => $c->get('ENV')['DB_USER'],
            'password'  => $c->get('ENV')['DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]);

        // Make this Capsule instance available globally via static methods
        $eloquent->setAsGlobal();

        // Setup the Eloquent ORM...
        $eloquent->bootEloquent();

        // Set the fetch mode to return associative arrays.
        $eloquent->setFetchMode(PDO::FETCH_ASSOC);

        return $eloquent;
    }
];

<?php

use Dotenv\Dotenv;
use LogicLeap\SasinduPharmacy\controllers\SiteController;
use LogicLeap\SasinduPharmacy\core\Application;

require_once __DIR__.'/../vendor/autoload.php';

//Loading database details to environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'rootPath' => dirname(__DIR__),
    'db' => [
        "servername" => $_ENV['DB_SERVERNAME'],
        "username" => $_ENV['DB_USERNAME'],
        "password" => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application($config);

// Web routes
$app->router->addGetRoute('/', [SiteController::class, 'login']);
$app->router->addPostRoute('/', [SiteController::class, 'login']);

$app->run();

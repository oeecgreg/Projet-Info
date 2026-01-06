<?php

session_start();

// Importation de l'autoloader généré par Composer
require __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
use Controllers\MainController;
use Config\Config;
use Controllers\Router\Router;

$loader = new Psr4AutoloaderClass();
$loader->register();

// Enregistrement des namespaces avec des chemins absolus
$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Models', __DIR__ . '/Models'); // Indispensable pour PersonnageDAO
$loader->addNamespace('Config', __DIR__ . '/Config');

$engine = new Engine('Views');

Config::load(__DIR__ . '/Config/dev.ini');

$router = new Router($engine);
$router->routing($_GET, $_POST);
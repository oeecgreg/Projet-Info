<?php

// Importation de l'autoloader généré par Composer
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
use Controllers\MainController;
use Config\Config;

$loader = new Psr4AutoloaderClass();
$loader->register();

// Enregistrement des namespaces avec des chemins absolus
$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Models', __DIR__ . '/Models'); // Indispensable pour PersonnageDAO
$loader->addNamespace('Config', __DIR__ . '/Config');

$templatesPath = 'Views'; // Remplacez par le chemin vers les fichiers de templates (a faire)
$engine = new Engine($templatesPath);

Config::load(__DIR__ . '/Config/dev.ini');

$controller = new MainController();
$controller->index();
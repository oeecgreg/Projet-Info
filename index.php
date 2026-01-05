<?php

// Importation de l'autoloader généré par Composer
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
use Controllers\MainController;

$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');
$loader->addNamespace('\Controllers', '/Controllers');

$templatesPath = 'Views'; // Remplacez par le chemin vers les fichiers de templates (a faire)
$engine = new Engine($templatesPath);

$controller = new MainController();
$controller->index();
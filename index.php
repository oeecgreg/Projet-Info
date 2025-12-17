<?php

// Importation de l'autoloader généré par Composer
require_once 'Helpers/Psr4AutoloaderClass.php';
use Helpers\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');


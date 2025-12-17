<?php

// Importation de l'autoloader généré par Composer
require_once 'Helpers/Psr4AutoloaderClass.php';
use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');

$templatesPath = 'Views'; // Remplacez par le chemin vers vos fichiers de templates
$engine = new Engine($templatesPath);

echo $engine->render('home',['gameName'=> "BrawlStars"]); // Remplacez 'home' par le nom de votre fichier de template
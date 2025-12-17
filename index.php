use App\Controller\HomeController;
use App\Model\User;

<?php
// Importation de l'autoloader généré par Composer
require_once 'vendor/autoload.php';

$loader = new App\Helpers\Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('League\Plates', '/vendor/league/plates/src');
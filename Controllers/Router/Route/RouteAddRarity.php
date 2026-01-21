<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Rarity;
use Models\RarityDAO;

class RouteAddRarity extends Route {
    private MainController $controller;

    public function __construct(MainController $controller) {
        $this->controller = $controller;
    }

    public function get($params = []) {
        if(!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
        // On demande au contrôleur d'afficher le formulaire
        return $this->controller->displayAddRarity();
    }

    public function post($params = []) {
        $name = $params['name'] ?? null;
        $color = $params['color_code'] ?? null;

        if ($name && $color) {
            $rarity = new Rarity();
            $rarity->setName($name);
            $rarity->setColorCode($color);

            $dao = new RarityDAO();
            $dao->add($rarity); // Il faudra ajouter la méthode add dans RarityDAO
            
            header('Location: index.php');
            exit;
        }
    }
}
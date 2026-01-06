<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteAddClasse extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        // Appelle la nouvelle méthode du contrôleur
        return $this->controller->displayAddClasse();
    }

    public function post($params = []) {}
}
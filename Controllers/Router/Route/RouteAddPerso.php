<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteAddPerso extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        return $this->controller->displayAddPerso();
    }

    public function post($params = [])
    {
        // On laissera vide pour l'instant, on gérera l'ajout en base plus tard
    }
}
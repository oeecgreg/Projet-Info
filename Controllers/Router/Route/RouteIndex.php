<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page d'accueil
 */
class RouteIndex extends Route
{
    private MainController $controller;

    /**
     * Construit la route avec le contrôleur principal
     * @param MainController $controller Le contrôleur principal
     */
    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    /** 
     * Gère les requêtes GET pour la page d'accueil
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function get($params = [])
    {
        return $this->controller->index();
    }

    /** 
     * Gère les requêtes POST pour la page d'accueil
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function post($params = [])
    {
        return $this->controller->index();
    }
}
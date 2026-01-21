<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour les logs
 */
class RouteLogs extends Route
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
     * Gère les requêtes GET pour les logs
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function get($params = [])
    {
        return $this->controller->displayLogs();
    }

    /** 
     * Gère les requêtes POST pour les logs (non utilisées ici)
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function post($params = []) {}
}
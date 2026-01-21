<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page de login
 */
class RouteLogin extends Route
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
     * Gère les requêtes GET pour la page de login
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function get($params = [])
    {
        return $this->controller->displayLogin();
    }

    /** 
     * Gère les requêtes POST pour la page de login
     * @param array $params Paramètres de la requête (doit contenir 'username' et 'password')
     * @return void
     */
    public function post($params = [])
    {
        $username = $params['username'] ?? null;
        $password = $params['password'] ?? null;

        return $this->controller->login($username, $password);
    }
}
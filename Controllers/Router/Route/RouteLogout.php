<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;

/**
 * Route pour la déconnexion
 */
class RouteLogout extends Route
{
    /** 
     * Gère les requêtes GET pour la déconnexion
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function get($params = [])
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    /** 
     * Gère les requêtes POST pour la déconnexion (non utilisées ici)
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function post($params = []) {}
}
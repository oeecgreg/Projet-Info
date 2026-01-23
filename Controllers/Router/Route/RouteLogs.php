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
        // --- SÉCURITÉ ADMIN ---
        // Si l'utilisateur n'est pas "admin", on refuse son accès. On refuse également l'accès si l'utilisateur n'est pas connecté.
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            $_SESSION['flash_message'] = "Accès refusé. Vous devez être administrateur.";
            $_SESSION['flash_type'] = "error";
            header('Location: index.php?action=login'); // Redirection vers le login
            exit;
        }
        // ----------------------
        return $this->controller->displayLogs();
    }

    /** 
     * Gère les requêtes POST pour les logs (non utilisées ici)
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function post($params = []) {}
}
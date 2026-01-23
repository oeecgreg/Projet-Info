<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour afficher la collection personnelle de l'utilisateur
 */
class RouteMyCollection extends Route
{
    /**
     * Indique si la route est protégée (réservée aux utilisateurs connectés)
     * @var bool
     */
    protected bool $isProtected = true; // Page réservée aux membres

    private MainController $controller;

    /**
     * Constructeur
     * @param MainController $controller Le contrôleur principal
     */
    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    /** 
     * Gère les requêtes GET pour afficher la collection personnelle
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function get($params = [])
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['flash_message'] = "Accès refusé. Vous devez être connecté.";
            $_SESSION['flash_type'] = "error";
            header('Location: index.php?action=login'); // Redirection vers le login
            exit;
        }
        return $this->controller->displayMyCollection();
    }

    /** 
     * Gère les requêtes POST pour les logs (non utilisées ici)
     * @param array $params Paramètres de la requête (non utilisés ici)
     * @return void
     */
    public function post($params = []) {}
}
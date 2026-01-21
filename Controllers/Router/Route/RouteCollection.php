<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\CollectionDAO;

/**
 * Route pour gérer la collection personnelle de l'utilisateur
 */
class RouteCollection extends Route
{
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
     * Gère les requêtes GET pour ajouter ou retirer un brawler de la collection
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function get($params = [])
    {
        // 1. Sécurité
        // (Le routeur s'en occupe normalement via protectRoute, mais on garde la logique métier)
        $userId = $_SESSION['user']['id'];
        $brawlerId = $params['id'] ?? null;
        $action = $params['mode'] ?? 'add'; 
        
        // --- NOUVEAU : On récupère la destination ---
        $redirect = $params['redirect'] ?? 'home'; // Par défaut : accueil
        // --------------------------------------------

        if ($brawlerId) {
            $dao = new CollectionDAO();
            
            if ($action === 'add') {
                $dao->add($userId, $brawlerId);
            } elseif ($action === 'remove') {
                $dao->remove($userId, $brawlerId);
            }
        }

        // --- NOUVEAU : Redirection intelligente ---
        if ($redirect === 'my-collection') {
            header('Location: index.php?action=my-collection');
        } else {
            header('Location: index.php');
        }
        exit;
    }

    public function post($params = []) {}
}
<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\PersonnageDAO;

class RouteDelPerso extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    // La suppression se fait généralement via un lien (GET) dans votre tableau
    public function get($params = [])
    {
        if(!isset($_SESSION["user"])) {
            header('Location: index.php?action=login');
            exit;
        }
        // 1. On récupère l'ID passé dans l'URL (ex: index.php?action=del-perso&id=4)
        $id = $params['id'] ?? null;

        if ($id) {
            $dao = new PersonnageDAO();
            // 2. On tente la suppression
            $dao->delete((int)$id);
        }

        // 3. Quoi qu'il arrive, on retourne à l'accueil
        header('Location: index.php');
        exit;
    }

    public function post($params = [])
    {
        // Pas de formulaire POST pour la suppression ici
        header('Location: index.php');
    }
}
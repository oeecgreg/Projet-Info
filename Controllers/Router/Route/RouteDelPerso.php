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
        $id = $params['id'] ?? null;
        if ($id) {
            $dao = new \Models\PersonnageDAO();
            // Optionnel : récupérer le nom avant de supprimer pour le log
            $brawler = $dao->getByID($id);
            $name = $brawler ? $brawler['name'] : "Inconnu";

            if ($dao->delete($id)) {
                // --- DEBUT AJOUT LOG ---
                $logDAO = new \Models\LogDAO();
                $username = $_SESSION['user']['username'] ?? 'Inconnu';
                $logDAO->addLog('DELETE', "A supprimé le Brawler : " . $name . " (ID: " . $id . ")", $username);
                // --- FIN AJOUT LOG ---
            }
        }
        header('Location: index.php');
        exit;
    }

    public function post($params = [])
    {
        // Pas de formulaire POST pour la suppression ici
        header('Location: index.php');
    }
}
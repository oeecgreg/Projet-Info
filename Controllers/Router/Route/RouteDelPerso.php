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

    // La suppression se fait via un lien (GET) dans le tableau
    public function get($params = [])
    {
        $id = $params['id'] ?? null;

        if ($id) {
            $dao = new \Models\PersonnageDAO();
            //On récupère les infos avant suppression pour le message
            $brawler = $dao->getByID($id);
            $name = $brawler ? $brawler['name'] : "Inconnu";

            if ($dao->delete($id)) {
                // --- LOG ---
                $logDAO = new \Models\LogDAO();
                $username = $_SESSION['user']['username'] ?? 'Inconnu';
                $logDAO->addLog('DELETE', "A supprimé le Brawler : " . $name . " (ID: " . $id . ")", $username);

                // --- MESSAGE FLASH SUCCESS ---
                $_SESSION['flash_message'] = "Le Brawler <strong>" . $name . "</strong> a été supprimé avec succès.";
                $_SESSION['flash_type'] = "success";
            } else {
                // --- MESSAGE FLASH ERROR ---
                $_SESSION['flash_message'] = "Erreur : Impossible de supprimer le Brawler.";
                $_SESSION['flash_type'] = "error";
            }
        } else {
            $_SESSION['flash_message'] = "Erreur : ID invalide.";
            $_SESSION['flash_type'] = "error";
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
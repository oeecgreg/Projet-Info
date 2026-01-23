<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\PersonnageDAO;

/**
 * Route pour la suppression d'un brawler
 */
class RouteDelPerso extends Route
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
     * Gère la requête GET pour supprimer un brawler
     * @param mixed $params
     * @return void
     */
    public function get($params = [])
    {
        $id = $params['id'] ?? null;

        // --- SÉCURITÉ ADMIN ---
        // Si l'utilisateur n'est pas "admin", on refuse son accès. On refuse également l'accès si l'utilisateur n'est pas connecté.
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            $_SESSION['flash_message'] = "Accès refusé : Réservé à l'administrateur.";
            $_SESSION['flash_type'] = "error";
            header('Location: index.php');
            exit;
        }
        // ----------------------

        if ($id) {
            $dao = new PersonnageDAO();
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

    /**
     * Pas de requête POST pour cette route
     * @param mixed $params
     * @return void
     */
    public function post($params = [])
    {
        // Pas de formulaire POST pour la suppression ici
        header('Location: index.php');
    }
}
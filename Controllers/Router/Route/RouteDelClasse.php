<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Models\ClasseDAO;
use Models\LogDAO;

/**
 * Route pour la suppression d'une classe
 */
class RouteDelClasse extends Route
{

    /**
     * Gère la requête GET pour supprimer une classe
     * @param mixed $params
     * @return void
     */
    public function get($params = [])
    {
        // Vérification Admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            header('Location: index.php');
            exit;
        }

        // On récupère l'ID (soit via $params, soit $_GET par sécurité)
        $id = $params['id'] ?? $_GET['id'] ?? null;

        if ($id) {
            $dao = new ClasseDAO();
            $classe = $dao->getById($id);
            $name = $classe ? $classe['name'] : "Inconnu";

            if ($dao->delete((int)$id)) {
                
                // --- LOG SUPPRESSION ---
                $logDAO = new LogDAO();
                $logDAO->addLog(
                    'Suppression', 
                    "Suppression de la classe " . $name . " (ID : " . $id . ")",
                    $_SESSION['user']['username']
                );

                $_SESSION['flash_message'] = "Classe supprimée !";
                $_SESSION['flash_type'] = "success";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la suppression.";
                $_SESSION['flash_type'] = "error";
            }
        }

        // Retour à la page de gestion
        header('Location: index.php?action=add-classe');
        exit;
    }

    /**
     * Gère la requête POST
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function post($params = []) {}
}
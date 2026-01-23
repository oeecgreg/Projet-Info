<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Models\ClasseDAO;

class RouteDelClasse extends Route
{
    public function get($params = [])
    {
        // 1. Sécurité Admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            header('Location: index.php');
            exit;
        }

        // 2. Suppression
        if (!empty($params['id'])) {
            $dao = new ClasseDAO();
            if ($dao->delete((int)$params['id'])) {
                $_SESSION['flash_message'] = "Classe supprimée avec succès !";
                $_SESSION['flash_type'] = "success";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la suppression.";
                $_SESSION['flash_type'] = "error";
            }
        }

        // 3. Retour à la liste
        header('Location: index.php?action=add-classe');
        exit;
    }

    public function post($params = []) {}
}
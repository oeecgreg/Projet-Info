<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Models\RarityDAO;

class RouteDelRarity extends Route
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
            $dao = new RarityDAO();
            if ($dao->delete((int)$params['id'])) {
                $_SESSION['flash_message'] = "Rareté supprimée avec succès !";
                $_SESSION['flash_type'] = "success";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la suppression.";
                $_SESSION['flash_type'] = "error";
            }
        }

        // 3. Retour à la liste
        header('Location: index.php?action=add-rarity');
        exit;
    }

    public function post($params = []) {}
}
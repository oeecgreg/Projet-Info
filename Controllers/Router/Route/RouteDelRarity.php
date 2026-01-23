<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Models\RarityDAO;
use Models\LogDAO;

/**
 * Route pour la suppression d'une rareté
 */
class RouteDelRarity extends Route
{
    /**
     * Gère la requête GET pour supprimer une rareté
     * @param mixed $params
     * @return void
     */
    public function get($params = [])
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            header('Location: index.php');
            exit;
        }

        $id = $params['id'] ?? $_GET['id'] ?? null;

        if ($id) {
            $dao = new RarityDAO();
            $rarity = $dao->getById($id);
            $id = $rarity ? $rarity['id'] : null;
            
            if ($dao->delete((int)$id)) {

                // --- LOG SUPPRESSION ---
                $logDAO = new LogDAO();
                $logDAO->addLog(
                    'Suppression', 
                    "Suppression rareté " . $rarity['name'] . "(ID : " . $id . ")", 
                    $_SESSION['user']['username']
                );

                $_SESSION['flash_message'] = "Rareté supprimée !";
                $_SESSION['flash_type'] = "success";
            }
        }

        header('Location: index.php?action=add-rarity');
        exit;
    }

    /**
     * Pas de requête POST pour cette route
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function post($params = []) {}
}
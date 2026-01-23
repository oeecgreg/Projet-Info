<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Rarity;
use Models\RarityDAO;
use Models\LogDAO;

/**
 * Route pour l'ajout d'une rareté
 */
class RouteAddRarity extends Route {

    protected bool $isProtected = true;

    private MainController $controller;

    /**
     * Constructeur
     * @param MainController $controller Le contrôleur principal
     */
    public function __construct(MainController $controller) {
        $this->controller = $controller;
    }

    /**
     * Gère la requête GET pour afficher le formulaire d'ajout de rareté
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function get($params = []) {
        // --- SÉCURITÉ ADMIN ---
        // Si l'utilisateur n'est pas "admin", on refuse son accès. On refuse également l'accès si l'utilisateur n'est pas connecté.
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            $_SESSION['flash_message'] = "Accès refusé : Réservé à l'administrateur.";
            $_SESSION['flash_type'] = "error";
            header('Location: index.php');
            exit;
        }
        // ----------------------
        $dao = new RarityDAO();
        $rarities = $dao->getAll();

        // Appel du contrôleur avec les données
        return $this->controller->displayAddRarity($rarities);
    }

    /**
     * Gère la requête POST pour traiter le formulaire d'ajout de rareté
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function post($params = [])
    {
        // On utilise $_POST directement pour être sûr de tout récupérer
        $name = $_POST['name'] ?? null;
        $color_code = $_POST['color_code'] ?? null;
        // var_dump($_POST); die();

        // Vérification que les champs ne sont pas vides
        if (!empty($name) && !empty($color_code)) {
            
            // Création de l'objet
            $rarity = new Rarity(); 
            $rarity->setName($name);
            $rarity->setColorCode($color_code);

            $dao = new RarityDAO();
            
            if ($dao->add($rarity)) {
                
                // Log
                $logDAO = new LogDAO();
                $logDAO->addLog(
                    'Ajout', 
                    "Ajout rareté : " . $name . " (" . $color_code . ")", 
                    $_SESSION['user']['username'] ?? 'Admin'
                );

                $_SESSION['flash_message'] = "Rareté ajoutée avec succès !";
                $_SESSION['flash_type'] = "success";
                
                header('Location: index.php?action=add-rarity');
                exit;
            }
        }
        
        // Si on arrive ici, c'est que le if a échoué
        $_SESSION['flash_message'] = "Erreur lors de l'ajout de la rareté. (Nom peut-être déjà existant.)";
        $_SESSION['flash_type'] = "error";
        header('Location: index.php?action=add-rarity');
        exit;
    }
}
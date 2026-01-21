<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Personnage;
use Models\PersonnageDAO;

class RouteAddPerso extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    // Affiche le formulaire (méthode GET)
    public function get($params = [])
    {
        if(!isset($_SESSION["user"])) {
            header('Location: index.php?action=login');
            exit;
        }
        return $this->controller->displayAddPerso();
    }

    // Traite le formulaire (méthode POST)
    public function post($params = [])
    {
        // Récupération des données du formulaire et vérification que le formulaire est complet
        $name = $params['name'] ?? null;
        $classe = $params['classe'] ?? null;
        $rarity = $params['rarity'] ?? null;

        // Vérification basique que les champs sont remplis
        if ($name && $classe && $rarity) {

            $perso = new Personnage();
            $perso->setName($name);
            $perso->setRarity($rarity);
            $perso->setClasse($classe);
            $perso->setUrlImg("public/img/" . $name . ".png");

            $dao = new PersonnageDAO();
            if ($dao->add($perso)) {
                // --- DEBUT AJOUT LOG ---
                $logDAO = new \Models\LogDAO();
                $username = $_SESSION['user']['username'] ?? 'Inconnu';
                $logDAO->addLog('ADD', "A ajouté le Brawler : " . $name, $username);
                // --- FIN AJOUT LOG ---

                header('Location: index.php');
                exit;
            }

        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
}
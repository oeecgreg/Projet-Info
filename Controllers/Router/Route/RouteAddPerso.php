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
        // 1. Récupération des données du formulaire
        $name = $params['name'] ?? null;
        $classe = $params['classe'] ?? null;
        $rarity = $params['rarity'] ?? null;

        // 2. Vérification basique
        if ($name && $classe && $rarity) {
            
            // 3. Création de l'objet Personnage
            $perso = new Personnage();
            $perso->setName($name);
            $perso->setClasse($classe);
            $perso->setRarity($rarity);
            
            // 4. Gestion de l'image avec cas par défaut (Fallback)
            // On nettoie le nom pour créer le chemin théorique de l'image
            // $imageName = str_replace(' ', '', $name);
            $imageName = $perso->getName();
            $targetPath = "public/img/$imageName.png"; 

            // On vérifie si le fichier existe réellement sur le serveur
            if (file_exists($targetPath)) {
                $perso->setUrlImg($targetPath);
            } else {
                // Si l'image n'existe pas, on utilise l'image par défaut
                $perso->setUrlImg("public/img/unknown.png");
            }

            // 5. Enregistrement en base de données
            $dao = new PersonnageDAO();
            if ($dao->add($perso)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Erreur lors de l'enregistrement en base de données.";
            }
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
}
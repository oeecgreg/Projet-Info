<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Personnage;
use Models\PersonnageDAO;

class RouteEditPerso extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    // GET : On affiche le formulaire pré-rempli
    public function get($params = [])
    {
        $id = $params['id'] ?? null;
        return $this->controller->displayEditPerso($id);
    }

    // POST : On enregistre les modifications
    public function post($params = [])
    {
        // 1. Récupération des données (y compris l'ID caché)
        $id = $params['id'] ?? null;
        $name = $params['name'] ?? null;
        $classe = $params['classe'] ?? null;
        $rarity = $params['rarity'] ?? null;

        if ($id && $name && $classe && $rarity) {
            
            // 2. Création de l'objet avec les nouvelles données
            $perso = new Personnage();
            $perso->setId((int)$id);
            $perso->setName($name);
            $perso->setClasse($classe);
            $perso->setRarity($rarity);
            
            // 3. Gestion de l'image (Même logique que pour l'ajout)
            // Si le nom change, l'image change aussi !
            $imageName = str_replace(' ', '', $name); 
            $targetPath = "public/img/$imageName.png";

            if (file_exists($targetPath)) {
                $perso->setUrlImg($targetPath);
            } else {
                $perso->setUrlImg("public/img/unknown.png");
            }

            // 4. Mise à jour via le DAO
            $dao = new PersonnageDAO();
            if ($dao->update($perso)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Erreur lors de la mise à jour.";
            }
        } else {
            echo "Données manquantes.";
        }
    }
}
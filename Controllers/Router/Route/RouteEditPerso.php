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
        $id = $params['id'] ?? null;
        $name = $params['name'] ?? null;
        $classe = $params['classe'] ?? null;
        $rarity = $params['rarity'] ?? null;

        if ($id && $name && $classe && $rarity) {
            $perso = new \Models\Personnage();
            $perso->setId($id); // Important pour le UPDATE
            $perso->setName($name);
            $perso->setRarity($rarity);
            $perso->setClasse($classe);
            $perso->setUrlImg("public/img/" . $name . ".png");

            $dao = new \Models\PersonnageDAO();

            if ($dao->update($perso)) {
                // --- LOG ---
                $logDAO = new \Models\LogDAO();
                $username = $_SESSION['user']['username'] ?? 'Inconnu';
                $logDAO->addLog('UPDATE', "A modifié le Brawler : " . $name . " (ID: " . $id . ")", $username);

                // --- MESSAGE FLASH SUCCESS ---
                $_SESSION['flash_message'] = "Le Brawler <strong>" . $name . "</strong> a été modifié avec succès !";
                $_SESSION['flash_type'] = "success";

                header('Location: index.php');
                exit;
            } else {
                // --- MESSAGE FLASH ERROR ---
                $_SESSION['flash_message'] = "Erreur lors de la modification du Brawler.";
                $_SESSION['flash_type'] = "error";
                
                // En cas d'erreur, on pourrait peut-etre rediriger vers le formulaire, 
                // mais ici on renvoie direct à l'accueil pour simplifier.
                header('Location: index.php');
                exit;
            }
        } else {
            // Gestion des champs vides
            $_SESSION['flash_message'] = "Veuillez remplir tous les champs.";
            $_SESSION['flash_type'] = "error";
            header("Location: index.php?action=edit-perso&id=" . $id);
            exit;
        }
    }
}
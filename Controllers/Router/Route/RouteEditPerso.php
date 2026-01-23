<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Personnage;
use Models\PersonnageDAO;

/**
 * Route pour la modification d'un brawler
 */
class RouteEditPerso extends Route
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
     * Gère la requête GET pour afficher le formulaire de modification d'un brawler
     * @param mixed $params
     */
    public function get($params = [])
    {
        // --- SÉCURITÉ ADMIN ---
        // Si l'utilisateur n'est pas "admin", on refuse son accès. On refuse également l'accès si l'utilisateur n'est pas connecté.
        if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
            $_SESSION['flash_message'] = "Accès refusé : Réservé à l'administrateur.";
            $_SESSION['flash_type'] = "error";
            header('Location: index.php');
            exit;
        }
        // ----------------------
        $id = $params['id'] ?? null;
        return $this->controller->displayEditPerso($id);
    }

    /**
     * Gère la requête POST pour traiter le formulaire de modification d'un brawler
     * @param mixed $params
     */
    public function post($params = [])
    {
        $id = $params['id'] ?? null;
        $name = $params['name'] ?? null;
        $classe = $params['classe'] ?? null;
        $rarity = $params['rarity'] ?? null;

        if ($id && $name && $classe && $rarity) {
            $perso = new Personnage();
            $perso->setId($id); // Important pour le UPDATE
            $perso->setName($name);
            $perso->setRarity($rarity);
            $perso->setClasse($classe);
            $perso->setUrlImg("public/img/" . $name . ".png");

            $dao = new PersonnageDAO();

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
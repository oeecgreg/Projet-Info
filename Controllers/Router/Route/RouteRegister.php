<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\UserDAO;

/**
 * Route pour l'inscription d'un nouvel utilisateur
 */
class RouteRegister extends Route
{
    // Cette route doit être publique ! (pas de protected $isProtected = true)
    
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
     * Affiche le formulaire d'inscription
     * @param mixed $params
     * @return void
     */
    public function get($params = [])
    {
        // Si déjà connecté, on renvoie à l'accueil
        if (isset($_SESSION['user'])) {
            header('Location: index.php');
            exit;
        }
        echo $this->controller->displayRegister();
    }

    /**
     * Traite le formulaire d'inscription
     * @param mixed $params
     * @return void
     */
    public function post($params = [])
    {
        $username = $params['username'] ?? '';
        $password = $params['password'] ?? '';

        if (!empty($username) && !empty($password)) {
            $userDAO = new UserDAO();
            
            if ($userDAO->add($username, $password)) {
                // Succès -> On redirige vers le login avec un message
                $_SESSION['flash_message'] = "Compte créé avec succès ! Connectez-vous.";
                $_SESSION['flash_type'] = "success";
                header('Location: index.php?action=login');
                exit;
            } else {
                // Erreur (ex: pseudo pris)
                $_SESSION['flash_message'] = "Erreur : Ce nom d'utilisateur est déjà pris.";
                $_SESSION['flash_type'] = "error";
            }
        }
        
        // Si échec, on reste sur la page
        header('Location: index.php?action=register');
        exit;
    }
}
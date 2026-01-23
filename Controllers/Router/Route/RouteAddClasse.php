<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Classe;
use Models\ClasseDAO;
use Models\LogDAO;

/**
 * Route pour l'ajout d'une classe
 */
class RouteAddClasse extends Route
{
    protected bool $isProtected = true;
    
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
     * Gère la requête GET pour afficher le formulaire d'ajout de classe
     * @param array $params Paramètres de la requête
     * @return void
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
        // Récupération de la liste
        $dao = new ClasseDAO();
        $classes = $dao->getAll();

        return $this->controller->displayAddClasse($classes);
    }

    /**
     * Gère la requête POST pour traiter le formulaire d'ajout de classe
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function post($params = [])
    {
        // On récupère depuis $params (qui contient $_POST via ton Router)
        $name = $params['name'] ?? null;
        $url_img = $params['url_img'] ?? null;

        if ($name && $url_img) {
            // Création de l'objet
            $classe = new Classe(); // Assure-toi du bon namespace
            $classe->setName($name);
            $classe->setUrlImg($url_img);

            $dao = new ClasseDAO();
            
            if ($dao->add($classe)) {
                
                // --- 1. AJOUT DU LOG ---
                $logDAO = new LogDAO();
                $logDAO->addLog(
                    'Ajout', 
                    "Création de la classe : " . $name, 
                    $_SESSION['user']['username']
                );

                // --- 2. MESSAGE SUCCÈS ---
                $_SESSION['flash_message'] = "Classe ajoutée avec succès !";
                $_SESSION['flash_type'] = "success";

                // --- 3. REDIRECTION (On reste sur la page d'ajout) ---
                header('Location: index.php?action=add-classe');
                exit;
            }
        }
        
        // Gestion d'erreur
        $_SESSION['flash_message'] = "Erreur lors de l'ajout de la classe. (Nom peut-être déjà existant.)";
        $_SESSION['flash_type'] = "error";
        header('Location: index.php?action=add-classe');
        exit;
    }
}
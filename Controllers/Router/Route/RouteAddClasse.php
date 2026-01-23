<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Classe;
use Models\ClasseDAO;

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
        return $this->controller->displayAddClasse();
    }

    /**
     * Gère la requête POST pour traiter le formulaire d'ajout de classe
     * @param array $params Paramètres de la requête
     * @return void
     */
    public function post($params = [])
    {
        $name = $params['name'] ?? null;
        $url_img = $params['url_img'] ?? null;

        if ($name && $url_img) {
            $classe = new Classe();
            $classe->setName($name);
            $classe->setUrlImg($url_img);

            $dao = new ClasseDAO();
            if ($dao->add($classe)) {
                header('Location: index.php');
                exit;
            }
        }
        echo "Erreur lors de l'ajout de la classe.";
    }
}
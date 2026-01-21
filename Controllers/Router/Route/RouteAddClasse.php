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
        // Sécurité : vérifier la session
        if(!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
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
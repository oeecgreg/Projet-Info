<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddClasse;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteLogout;
use Controllers\Router\Route\RouteAddRarity;
use Controllers\Router\Route\RouteCollection;
use Controllers\Router\Route\RouteMyCollection;
use Controllers\Router\Route\RouteRegister;
use Controllers\Router\Route\RouteDelClasse;
use Controllers\Router\Route\RouteDelRarity;

/**
 * Classe de routage principal
 */
class Router
{
    private $routeList = [];
    private $ctrlList = [];
    private string $actionKey;
    private $engine; // Nécessaire pour instancier les contrôleurs

    /**
     * Construit le routeur avec le moteur de template et le nom de la clé d'action
     * @param mixed $engine Le moteur de template
     * @param string $name_of_action_key Le nom de la clé d'action dans les requêtes
     */
    public function __construct($engine, $name_of_action_key = "action")
    {
        $this->engine = $engine;
        $this->actionKey = $name_of_action_key;
        
        //On crée les contrôleurs
        $this->createControllerList();
        
        //On crée les routes
        $this->createRouteList();
    }

    /** 
     * Crée la liste des contrôleurs
     * @return void
     */
    private function createControllerList()
    {
        // On instancie le contrôleurs ici
        $this->ctrlList = [
            'main' => new MainController($this->engine),
        ];
    }

    /** 
     * Crée la liste des routes
     * @return void
     */
    private function createRouteList()
    {
        $this->routeList = [
            'index' => new RouteIndex($this->ctrlList['main']),
            'add-perso' => new RouteAddPerso($this->ctrlList['main']),
            'del-perso' => new RouteDelPerso($this->ctrlList['main']),
            'edit-perso' => new RouteEditPerso($this->ctrlList['main']),
            'add-classe' => new RouteAddClasse($this->ctrlList['main']),
            'add-rarity' => new RouteAddRarity($this->ctrlList['main']),
            'logs' => new RouteLogs($this->ctrlList['main']),
            'login' => new RouteLogin($this->ctrlList['main']),
            'my-collection' => new RouteMyCollection($this->ctrlList['main']),
            'collection' => new RouteCollection($this->ctrlList['main']),
            'register' => new RouteRegister($this->ctrlList['main']),
            'del-classe' => new RouteDelClasse(),
            'del-rarity' => new RouteDelRarity(),
            'logout' => new RouteLogout(),
        ];
    }

    /** 
     * Effectue le routage en fonction des paramètres GET et POST
     * @param array $get Paramètres GET de la requête
     * @param array $post Paramètres POST de la requête
     * @return void
     */
    public function routing($get, $post)
    {
        $action = $get['action'] ?? 'index';

        try {
            if (isset($this->routeList[$action])) {
                $route = $this->routeList[$action];

                // Sécurité : protection de la route si nécessaire
                $route->protectRoute();

                // Détermination de la méthode HTTP
                $method = $_SERVER['REQUEST_METHOD'];
                
                if ($method === 'POST') {
                    $route->action($post, 'POST'); // On envoie les données du formulaire
                } else {
                    $route->action($get, 'GET');   // On envoie les paramètres de l'URL (id, mode...)
                }

            } else {
                header('Location: index.php');
                exit;
            }
        } catch (\Exception $e) {
            $_SESSION['flash_message'] = "Vous devez être connecté pour accéder à cette page.";
            $_SESSION['flash_type'] = "error";
            header('Location: index.php?action=login');
            exit;
        }
    }
}
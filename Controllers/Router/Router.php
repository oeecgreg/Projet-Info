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
            'logout' => new RouteLogout(),
        ];
    }

    /** 
     * Effectue le routage en fonction des paramètres GET et POST
     * @param array $get Paramètres GET de la requête
     * @param array $post Paramètres POST de la requête
     * @return void
     */
    public function routing($get = [], $post = [])
    {
        // Récupération de l'action, sinon 'index' par défaut
        $action = $get[$this->actionKey] ?? 'index';

        // Vérifie si la route existe
        if (isset($this->routeList[$action])) {
            $route = $this->routeList[$action];
            
            // Si on a des données POST, on appelle post(), sinon get()
            if (!empty($post)) {
                $route->action($post, 'POST');
            } else {
                $route->action($get, 'GET');
            }
        } else {
            // Si l'action n'existe pas -> redirection vers index ou page 404
            $this->routeList['index']->action();
        }
    }
}
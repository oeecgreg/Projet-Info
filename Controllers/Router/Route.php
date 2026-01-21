<?php

namespace Controllers\Router;

use Exception;

/**
 * Classe abstraite de base pour toutes les routes
 */
abstract class Route
{

    protected bool $isProtected = false;
    /** 
     * Gère les requêtes en fonction de la méthode HTTP
     * @param array $params Paramètres de la requête
     * @param string $method Méthode HTTP ('GET' ou 'POST')
     * @return void
     */
    public function action($params = [], $method = 'GET')
    {
        if ($method === 'GET') {
            return $this->get($params);
        } else {
            return $this->post($params);
        }
    }

    /** 
     * Récupère un paramètre d'un tableau avec gestion des erreurs
     * @param array $array Le tableau de paramètres
     * @param string $paramName Le nom du paramètre à récupérer
     * @param bool $canBeEmpty Indique si le paramètre peut être vide
     * @return mixed La valeur du paramètre
     * @throws Exception Si le paramètre est absent ou vide (selon $canBeEmpty)
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        } else {
            throw new Exception("Paramètre '$paramName' absent");
        }
    }

    /**
     * Vérifie si l'utilisateur a le droit d'accéder à la route
     * @throws Exception Si accès refusé
     */
    public function protectRoute(): void
    {
        if ($this->isProtected && !isset($_SESSION['user'])) {
            throw new Exception("Accès refusé");
        }
    }

    // Méthodes abstraites à implémenter dans les classes dérivées
    abstract public function get($params = []);
    abstract public function post($params = []);
}
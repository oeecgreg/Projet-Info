<?php

namespace Controllers\Router;

use Exception;

abstract class Route
{
    // Méthode principale appelée par le routeur
    public function action($params = [], $method = 'GET')
    {
        if ($method === 'GET') {
            return $this->get($params);
        } else {
            return $this->post($params);
        }
    }

    // Méthode utilitaire pour récupérer un paramètre en sécurité (décrite en page 3)
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

    // Méthodes abstraites à définir dans chaque route fille
    abstract public function get($params = []);
    abstract public function post($params = []);
}
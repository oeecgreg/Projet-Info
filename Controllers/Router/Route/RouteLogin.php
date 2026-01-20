<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteLogin extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        return $this->controller->displayLogin();
    }

    public function post($params = [])
    {
        $username = $params['username'] ?? null;
        $password = $params['password'] ?? null;

        return $this->controller->login($username, $password);
    }
}
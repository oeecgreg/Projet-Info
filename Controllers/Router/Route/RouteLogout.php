<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteLogout extends Route
{
    public function get($params = [])
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function post($params = []) {}
}
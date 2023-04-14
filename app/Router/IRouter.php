<?php

namespace App\Router;

interface IRouter
{
    public function get(string $route, $controller, string $method_name);

    public function post(string $route, $controller, string $method_name);

}
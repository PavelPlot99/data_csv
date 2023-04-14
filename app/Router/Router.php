<?php

namespace App\Router;

use App\Request\Request;

class Router implements IRouter
{
    private array $route_list = [];
    private string $url;
    private array $args;
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $route
     * @param $controller
     * @param string $method_name
     * @return void
     */
    public function get(string $route, $controller, string $method_name)
    {
        $this->route_list[] = [
            'url' => $route,
            'controller_class' => $controller,
            'method_name' => $method_name,
            'method' => 'GET',
        ];
    }

    public function post(string $route, $controller, string $method_name)
    {
        $this->route_list[] = [
            'url' => $route,
            'controller_class' => $controller,
            'method_name' => $method_name,
            'method' => 'POST',
        ];
    }

    public function run()
    {
        $url = $this->request->getUrl();
        $route = $this->trackRoute($url);
        if (!$route) {
            return;
        }

        $controller = new $route['controller_class'];
        $controller->{$route['method_name']}($this->request);
    }

    private function trackRoute($url): array|bool
    {
        $url_array = explode('/', $url);
        $regex_param = '/^\{[a-zA-Z]+\}$/';

        foreach ($this->route_list as $route) {
            $route_url_array = explode('/', $route['url']);
            $isEquial = false;
            $this->args = [];
            foreach ($url_array as $key => $url_item) {

                if ($url_item !== $route_url_array[$key] and
                    isset($route_url_array[$key]) && isset($url_item) and
                    preg_match($regex_param, $route_url_array[$key]) or
                    $url_item === $route_url_array[$key]) {
                    $isEquial = true;
                }
                else {
                    $isEquial = false;
                    break;
                }

                if (preg_match($regex_param, $route_url_array[$key]) AND isset($route_url_array[$key]) && isset($url_item)) {
                    $this->args[str_replace(["{", "}"],"", $route_url_array[$key])] =  $url_item;
                    $this->request->setArgs($this->args);
                }
            }

            if ($isEquial) {
                return $route;
            }

        }

        return false;
    }

}
<?php

namespace App\Router\Factory;

use App\Request\Request;
use App\Router\IRouter;
use App\Router\Router;

interface RouterFactory
{
    public static function createRouter(Request $request):IRouter;
}
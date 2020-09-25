<?php


namespace ishop;


class Router
{

    protected static $routes = [];    //тут хранится таблица маршрутов(записываем имеющие маршруты на нашем сайте)
    protected static $route = [];     //тут хранится текущий маршрут(если найдено соответсвие с каким-то адресом в таблице маршрутов)

    public static function add($regexp, $route = [])
    { //$regexp -регулярное выражние; $route - опциональный конкретны маршрут/выражение которое соответсвует регулярному выражению
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }
}

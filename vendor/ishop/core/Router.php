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

    public static function getRoute(){
        return self::$route;
    }

    public static function dispatch($url){             // вызывает matchRoute($url) (вернет либо есть, либо нет) Либо вызывает соотв контроллер или вызывает ошибку 404
        if(self::matchRoute($url)) {                   // создаем условие для matchRoute
            echo 'OK';
        }else{
            echo 'NO';
        }
    }

    public static function matchRoute($url) {          // ищет соответстиве в таблице маршрутов
    }

}

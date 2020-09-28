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

    public static function dispatch($url)
    {             // вызывает matchRoute($url) (вернет либо есть, либо нет) Либо вызывает соотв контроллер или вызывает ошибку 404
        if (self::matchRoute($url)) {                   // создаем условие для matchRoute
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase (self::$route['action']) . 'Action';
                if (method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                } else {
                    throw new \Exception("Метод $controller::$action не найдена", 404);
                }
            } else {
            throw new \Exception("Контроллер $controller не найдена", 404);
        }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public static function matchRoute($url)
    {          // ищет соответстиве в таблице маршрутов
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['contrpller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                debug(self::$route);
                return true;
            }
        }
        return false;
    }

    //CamelCase
    protected static function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    // camelCase
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));

    }
}



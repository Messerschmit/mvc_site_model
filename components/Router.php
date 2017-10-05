<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {

        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
            //return substr($_SERVER['REQUEST_URI'], strlen('/localhost/shop_test/'));
        }
    }

    /**
     *
     * Определяет необходимый контроллер и action
     *
     */

    public function run()
    {
        //получить строку запроса
        $uri = $this->getURI();

        //проверить наличие запроса в routes.php
        foreach ($this->routes as $uriPattern => $path){
            //сравниваем $uriPattern $uri
            if (preg_match("~$uriPattern~", $uri)){

                //Получаем внутренний путь из внешнего согласно правила
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //опредилить какой контроллер
                //и action обрабатывает запрос, определить параметры
                $segment = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segment).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segment));
                $parameters = $segment;

                //подключить файл класса-контроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                //создать объект вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName),$parameters);

                if ($result != null){
                    break;
                }
            }
        }

    }
}
<?php
class Router {
    public static function dispatch() {
        $c = $_GET['c'] ?? 'category';
        $a = $_GET['a'] ?? 'index';

        $controllerName = ucfirst($c) . 'Controller';
        $file = __DIR__ . '/../app/Controllers/' . $controllerName . '.php';

        if (!file_exists($file)) die('Controller not found');

        require $file;
        $controller = new $controllerName();

        if (!method_exists($controller, $a)) die('Action not found');

        $controller->$a();
    }
}

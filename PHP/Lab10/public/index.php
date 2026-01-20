<?php
$controller = ucfirst($_GET['controller'] ?? 'product') . 'Controller';
$action = $_GET['action'] ?? 'index';

require "../app/Controllers/$controller.php";
$c = new $controller();
$c->$action();

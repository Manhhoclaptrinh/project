<?php
require_once __DIR__ . '/../app/controllers/StudentController.php';

$controller = new StudentController();

if (isset($_GET['api'])) {
    $controller->api();
} else {
    $controller->index();
}

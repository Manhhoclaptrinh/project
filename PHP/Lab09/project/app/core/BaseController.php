<?php
class BaseController {
    protected function view($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/layout.php';
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

<?php
class Controller {
    protected function view($path, $data = []) {
        extract($data);
        require __DIR__ . '/../app/Views/' . $path . '.php';
    }
}

<?php
require_once '../app/Models/ProductRepository.php';

class ProductController {
    private $repo;

    public function __construct() {
        $this->repo = new ProductRepository();
    }

    public function index() {
        $kw = $_GET['q'] ?? '';
        $sort = $_GET['sort'] ?? 'id';
        $products = $this->repo->all($kw, $sort);
        require '../app/Views/products/index.php';
    }

    public function create() {
        require '../app/Views/products/create.php';
    }

    public function store() {
        if ($_POST['price'] < 0) die("Giá không hợp lệ");
        $this->repo->create($_POST);
        header("Location: index.php?controller=product&action=index");
    }

    public function edit() {
        $product = $this->repo->find($_GET['id']);
        require '../app/Views/products/edit.php';
    }

    public function update() {
        $this->repo->update($_GET['id'], $_POST);
        header("Location: index.php?controller=product&action=index");
    }

    public function delete() {
        $this->repo->delete($_GET['id']);
        header("Location: index.php?controller=product&action=index");
    }
}

<?php
require __DIR__ . '/../Models/Category.php';

class CategoryController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new Category();
    }

    public function index() {
        $q = $_GET['q'] ?? '';
        $categories = $this->model->getAll($q);
        $this->view('categories/index', compact('categories', 'q'));
    }

    public function create() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (strlen($name) < 2) {
                $error = 'Tên danh mục phải ≥ 2 ký tự';
            } else {
                $this->model->insert($name);
                header('Location: index.php?c=category');
                exit;
            }
        }
        $this->view('categories/create', compact('error'));
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $category = $this->model->findById($id);
        if (!$category) die('Not found');

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (strlen($name) < 2) {
                $error = 'Tên danh mục không hợp lệ';
            } else {
                $this->model->update($id, $name);
                header('Location: index.php?c=category');
                exit;
            }
        }
        $this->view('categories/edit', compact('category', 'error'));
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        header('Location: index.php?c=category');
    }
}

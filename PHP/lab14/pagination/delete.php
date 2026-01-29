<?php
require_once 'config/database.php';
require_once 'models/Product.php';

$conn = Database::connect();
$productModel = new Product($conn);

$id = $_GET['id'];
$page = $_GET['page'] ?? 1;

$productModel->delete($id);

header("Location: index.php?page=$page");
exit;

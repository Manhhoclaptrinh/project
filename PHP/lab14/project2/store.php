<?php
session_start();
require 'config/database.php';
require 'helpers/flash.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        set_flash('msg', 'Tên danh mục không được để trống', 'danger');
    } else {
        $stmt = $pdo->prepare("INSERT INTO categories(name) VALUES(?)");
        $stmt->execute([$name]);
        set_flash('msg', 'Thêm danh mục thành công', 'success');
    }

    header("Location: index.php");
    exit;
}

<?php
session_start();
require 'config/database.php';
require 'helpers/flash.php';

$id   = $_POST['id'] ?? 0;
$name = trim($_POST['name'] ?? '');

if ($name === '') {
    set_flash('msg', 'Cập nhật thất bại: dữ liệu rỗng', 'danger');
} else {
    $stmt = $pdo->prepare("UPDATE categories SET name=? WHERE id=?");
    $stmt->execute([$name, $id]);
    set_flash('msg', 'Cập nhật thành công', 'success');
}

header("Location: index.php");
exit;

<?php
session_start();
require 'config/database.php';
require 'helpers/flash.php';

$id = $_POST['id'] ?? 0;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id=?");
    $stmt->execute([$id]);
    set_flash('msg', 'Xóa thành công', 'success');
} else {
    set_flash('msg', 'Xóa thất bại', 'danger');
}

header("Location: index.php");
exit;

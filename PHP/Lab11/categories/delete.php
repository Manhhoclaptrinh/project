<?php
require 'config.php';
require 'flash.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("DELETE FROM categories WHERE id=?");
$stmt->execute([$id]);

set_flash('Đã xóa danh mục');
header("Location: index.php");

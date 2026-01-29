<?php
session_start();
require 'config/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Sửa danh mục</h3>

    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <label>Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']) ?>">
        </div>
        <button class="btn btn-success">Cập nhật</button>
    </form>
</div>
</body>
</html>

<?php
session_start();
require 'helpers/flash.php';
require 'config/database.php';

// Lấy dữ liệu
$stmt = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
$categories = $stmt->fetchAll();

$flash = get_flash('msg');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">

    <h3>Danh sách danh mục</h3>
    <a href="create.php" class="btn btn-primary mb-3">+ Thêm mới</a>

    <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show">
            <?= htmlspecialchars($flash['message']) ?>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($categories as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="delete.php" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

</div>
</body>
</html>

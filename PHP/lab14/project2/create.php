<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Thêm danh mục</h3>

    <form action="store.php" method="post">
        <div class="mb-3">
            <label>Tên danh mục</label>
            <input type="text" name="name" class="form-control">
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>

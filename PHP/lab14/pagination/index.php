<?php
require_once 'config/database.php';
require_once 'models/Product.php';

$conn = Database::connect();
$productModel = new Product($conn);

$limit = 5;

// Lấy page từ URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Tổng bản ghi
$totalRecords = $productModel->countAll();
$totalPages = ceil($totalRecords / $limit);

// RÀNG BUỘC PAGE
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

// OFFSET
$offset = ($page - 1) * $limit;

// Lấy dữ liệu
$products = $productModel->getPage($limit, $offset);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pagination</title>
</head>
<body>

<h2>DANH SÁCH SẢN PHẨM</h2>

<p>Trang <?= $page ?>/<?= $totalPages ?> – Tổng <?= $totalRecords ?> bản ghi</p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['name'] ?></td>
        <td><?= $p['price'] ?></td>
        <td>
            <a href="edit.php?id=<?= $p['id'] ?>&page=<?= $page ?>">Sửa</a> |
            <a href="delete.php?id=<?= $p['id'] ?>&page=<?= $page ?>"
               onclick="return confirm('Xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<!-- PAGINATION -->
<div>
    <a href="?page=1">First</a>

    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
            <strong><?= $i ?></strong>
        <?php else: ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>">Next</a>
    <?php endif; ?>

    <a href="?page=<?= $totalPages ?>">Last</a>
</div>

</body>
</html>

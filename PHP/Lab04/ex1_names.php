<?php
// Lấy dữ liệu GET
$rawNames = $_GET['names'] ?? '';

// Tạo mảng
$names = [];

if (trim($rawNames) !== '') {
    // Tách chuỗi bằng dấu phẩy
    $parts = explode(',', $rawNames);

    // Trim từng phần tử
    $parts = array_map('trim', $parts);

    // Loại phần tử rỗng
    $names = array_filter($parts, function ($name) {
        return $name !== '';
    });
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Danh sách tên</title>
</head>
<body>

<h2>Bài 1 — Chuỗi → Danh sách tên (GET)</h2>

<p><strong>Chuỗi gốc:</strong>
    <?= htmlspecialchars($rawNames) ?>
</p>

<?php if (empty($names)): ?>
    <p style="color:red;">Chưa có dữ liệu hợp lệ</p>
<?php else: ?>
    <p><strong>Số lượng tên hợp lệ:</strong>
        <?= count($names) ?>
    </p>

    <ol>
        <?php foreach ($names as $name): ?>
            <li><?= htmlspecialchars($name) ?></li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>

</body>
</html>

<?php
$filePath = "../data/books.json";
$books = [];

if (file_exists($filePath)) {
    $books = json_decode(file_get_contents($filePath), true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách sách</title>
<style>
body { font-family: Arial; margin: 30px; }
table { border-collapse: collapse; width: 100%; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background: #f0f0f0; }
</style>
</head>
<body>

<h2>Danh sách sách trong kho</h2>

<table>
<tr>
    <th>Mã sách</th>
    <th>Tên sách</th>
    <th>Tác giả</th>
    <th>Năm</th>
    <th>Thể loại</th>
    <th>Số lượng</th>
</tr>

<?php if (empty($books)): ?>
<tr><td colspan="6">Chưa có sách</td></tr>
<?php else: ?>
<?php foreach ($books as $b): ?>
<tr>
    <td><?= htmlspecialchars($b['code']) ?></td>
    <td><?= htmlspecialchars($b['title']) ?></td>
    <td><?= htmlspecialchars($b['author']) ?></td>
    <td><?= htmlspecialchars($b['year']) ?></td>
    <td><?= htmlspecialchars($b['category']) ?></td>
    <td><?= htmlspecialchars($b['quantity']) ?></td>
</tr>
<?php endforeach; ?>
<?php endif; ?>

</table>

<p><a href="add_book.php">← Thêm sách mới</a></p>

</body>
</html>

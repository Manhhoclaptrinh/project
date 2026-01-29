<?php
require_once __DIR__ . '/../config/database.php';

$db = Database::connect();
$stmt = $db->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
<tr>
    <th>Ảnh</th><th>Tên</th><th>Giá</th><th>Action</th>
</tr>

<?php foreach ($products as $p): ?>
<tr>
    <td><img src="<?= $p['image'] ?>" width="80"></td>
    <td><?= $p['name'] ?></td>
    <td><?= $p['price'] ?></td>
    <td>Sửa</td>
</tr>
<?php endforeach; ?>
</table>

<?php
require 'config.php';
require 'flash.php';

$search = trim($_GET['search'] ?? '');

$sql = "SELECT * FROM categories WHERE 1";
$params = [];

if ($search !== '') {
    $sql .= " AND (name LIKE :s OR slug LIKE :s)";
    $params[':s'] = "%$search%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$categories = $stmt->fetchAll();
?>

<h2>Danh mục</h2>

<?php show_flash(); ?>

<form method="get">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
    <a href="create.php">➕ Thêm mới</a>
</form>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th><th>Name</th><th>Slug</th><th>Status</th><th>Actions</th>
</tr>

<?php foreach ($categories as $c): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= htmlspecialchars($c['name']) ?></td>
    <td><?= htmlspecialchars($c['slug']) ?></td>
    <td><?= $c['status'] ? 'Active' : 'Inactive' ?></td>
    <td>
        <a href="edit.php?id=<?= $c['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $c['id'] ?>"
           onclick="return confirm('Xóa danh mục này?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

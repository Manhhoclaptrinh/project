<?php
require 'config.php';
require 'flash.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
if (!$data) die("Không tồn tại");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = array_merge($data, $_POST);

    if (strlen($data['name']) < 3) {
        $errors['name'] = 'Name quá ngắn';
    }

    $stmt = $pdo->prepare(
        "SELECT COUNT(*) FROM categories WHERE slug=? AND id<>?"
    );
    $stmt->execute([$data['slug'], $id]);
    if ($stmt->fetchColumn() > 0) {
        $errors['slug'] = 'Slug đã tồn tại';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "UPDATE categories
             SET name=?, slug=?, description=?, status=?
             WHERE id=?"
        );
        $stmt->execute([
            $data['name'], $data['slug'],
            $data['description'], $data['status'], $id
        ]);
        set_flash('Cập nhật thành công');
        header("Location: index.php");
        exit;
    }
}
?>

<h2>Chỉnh sửa danh mục</h2>

<form method="post">
Name:<br>
<input name="name" value="<?= htmlspecialchars($data['name']) ?>">
<div style="color:red"><?= $errors['name'] ?? '' ?></div>

Slug:<br>
<input name="slug" value="<?= htmlspecialchars($data['slug']) ?>">
<div style="color:red"><?= $errors['slug'] ?? '' ?></div>

Description:<br>
<textarea name="description"><?= htmlspecialchars($data['description']) ?></textarea>

Status:<br>
<select name="status">
    <option value="1" <?= $data['status']==1?'selected':'' ?>>Active</option>
    <option value="0" <?= $data['status']==0?'selected':'' ?>>Inactive</option>
</select>
<div style="color:red"><?= $errors['status'] ?? '' ?></div>

<br>
<button>Save</button>
<a href="index.php">Back</a>
</form>

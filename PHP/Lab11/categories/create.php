<?php
require 'config.php';
require 'flash.php';

$errors = [];
$data = ['name'=>'','slug'=>'','description'=>'','status'=>1];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($data as $k => $v) {
        $data[$k] = trim($_POST[$k] ?? '');
    }

    if (strlen($data['name']) < 3 || strlen($data['name']) > 100) {
        $errors['name'] = 'Name 3–100 ký tự';
    }

    if (!preg_match('/^[a-z0-9-]+$/', $data['slug'])) {
        $errors['slug'] = 'Slug chỉ gồm a-z, 0-9, -';
    }

    if (!in_array($data['status'], ['0','1'], true)) {
        $errors['status'] = 'Status không hợp lệ';
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE slug=?");
    $stmt->execute([$data['slug']]);
    if ($stmt->fetchColumn() > 0) {
        $errors['slug'] = 'Slug đã tồn tại';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "INSERT INTO categories(name,slug,description,status)
             VALUES (?,?,?,?)"
        );
        $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['status']
        ]);
        set_flash('Thêm thành công');
        header("Location: index.php");
        exit;
    }
}
?>

<h2>Thêm danh mục</h2>

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

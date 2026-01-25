<h2>Sửa danh mục</h2>
<?php if ($error): ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php endif ?>
<form method="post">
    <input name="name" value="<?= htmlspecialchars($category['name']) ?>">
    <button>Cập nhật</button>
</form>

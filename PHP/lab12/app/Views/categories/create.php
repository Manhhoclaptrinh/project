<h2>Thêm danh mục</h2>
<?php if ($error): ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php endif ?>
<form method="post">
    <input name="name">
    <button>Lưu</button>
</form>

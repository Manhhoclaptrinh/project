<h2>Danh mục</h2>

<form>
    <input type="hidden" name="c" value="category">
    <input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Tìm tên">
    <button>Tìm</button>
</form>

<a href="index.php?c=category&a=create">+ Thêm</a>

<table border="1" cellpadding="5">
<tr>
  <th>ID</th><th>Name</th><th>Action</th>
</tr>
<?php foreach ($categories as $c): ?>
<tr>
  <td><?= $c['id'] ?></td>
  <td><?= htmlspecialchars($c['name']) ?></td>
  <td>
    <a href="index.php?c=category&a=edit&id=<?= $c['id'] ?>">Sửa</a>
    |
    <a onclick="return confirm('Xóa?')"
       href="index.php?c=category&a=delete&id=<?= $c['id'] ?>">Xóa</a>
  </td>
</tr>
<?php endforeach ?>
</table>

<h2>Danh sách sản phẩm</h2>

<form method="get">
    <input type="hidden" name="controller" value="product">
    <input type="hidden" name="action" value="index">

    Tìm kiếm:
    <input type="text" name="q" value="<?= $_GET['q'] ?? '' ?>">

    Sắp xếp:
    <select name="sort">
        <option value="id">ID</option>
        <option value="name">Tên</option>
        <option value="price">Giá</option>
        <option value="stock">Tồn kho</option>
    </select>

    <button type="submit">Lọc</button>
</form>

<a href="index.php?controller=product&action=create">+ Thêm sản phẩm</a>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Tên</th>
    <th>SKU</th>
    <th>Giá</th>
    <th>Tồn</th>
    <th>Hành động</th>
</tr>

<?php foreach ($products as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['name'] ?></td>
    <td><?= $p['sku'] ?></td>
    <td><?= number_format($p['price']) ?></td>
    <td><?= $p['stock'] ?></td>
    <td>
        <a href="index.php?controller=product&action=edit&id=<?= $p['id'] ?>">Sửa</a> |
        <a href="index.php?controller=product&action=delete&id=<?= $p['id'] ?>"
           onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

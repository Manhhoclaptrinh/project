<h2>Danh sách khách hàng</h2>

<a href="index.php?controller=customer&action=create">+ Thêm khách hàng</a>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Họ tên</th>
    <th>Email</th>
    <th>Điện thoại</th>
</tr>

<?php foreach ($customers as $c): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= $c['full_name'] ?></td>
    <td><?= $c['email'] ?></td>
    <td><?= $c['phone'] ?></td>
</tr>
<?php endforeach; ?>
</table>

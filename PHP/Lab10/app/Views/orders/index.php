<h2>Danh sách đơn hàng</h2>

<a href="index.php?controller=order&action=create">+ Tạo đơn hàng</a>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Khách hàng</th>
    <th>Ngày</th>
    <th>Tổng tiền</th>
    <th>Chi tiết</th>
</tr>

<?php foreach ($orders as $o): ?>
<tr>
    <td><?= $o['id'] ?></td>
    <td><?= $o['full_name'] ?></td>
    <td><?= $o['order_date'] ?></td>
    <td><?= number_format($o['total']) ?></td>
    <td>
        <a href="index.php?controller=order&action=show&id=<?= $o['id'] ?>">
            Xem
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

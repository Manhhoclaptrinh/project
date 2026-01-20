<h2>Chi tiết đơn hàng #<?= $order['id'] ?></h2>

<p>Khách hàng: <b><?= $order['full_name'] ?></b></p>
<p>Ngày đặt: <?= $order['order_date'] ?></p>
<p>Tổng tiền: <b><?= number_format($order['total']) ?></b></p>

<table border="1" cellpadding="5">
<tr>
    <th>Sản phẩm</th>
    <th>Số lượng</th>
    <th>Giá</th>
    <th>Thành tiền</th>
</tr>

<?php foreach ($items as $i): ?>
<tr>
    <td><?= $i['name'] ?></td>
    <td><?= $i['qty'] ?></td>
    <td><?= number_format($i['price']) ?></td>
    <td><?= number_format($i['qty'] * $i['price']) ?></td>
</tr>
<?php endforeach; ?>
</table>

<h2>Tạo đơn hàng</h2>

<form method="post" action="index.php?controller=order&action=store">

    Khách hàng:
    <select name="customer_id" required>
        <?php foreach ($customers as $c): ?>
            <option value="<?= $c['id'] ?>">
                <?= $c['full_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h3>Sản phẩm</h3>

    <?php foreach ($products as $p): ?>
        <div>
            <?= $p['name'] ?> (<?= number_format($p['price']) ?>)
            <input type="number"
                   name="items[<?= $p['id'] ?>]"
                   min="0" value="0">
        </div>
    <?php endforeach; ?>

    <br>
    <button type="submit">Tạo đơn</button>
</form>

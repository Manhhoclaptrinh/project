<h2>Thêm sản phẩm</h2>

<form method="post" action="index.php?controller=product&action=store">
    Tên:
    <input type="text" name="name" required><br><br>

    SKU:
    <input type="text" name="sku"><br><br>

    Giá:
    <input type="number" step="0.01" name="price" min="0" required><br><br>

    Tồn kho:
    <input type="number" name="stock" min="0" required><br><br>

    <button type="submit">Lưu</button>
</form>

<h2>Sửa sản phẩm</h2>

<form method="post"
      action="index.php?controller=product&action=update&id=<?= $product['id'] ?>">

    Tên:
    <input type="text" name="name" value="<?= $product['name'] ?>" required><br><br>

    SKU:
    <input type="text" name="sku" value="<?= $product['sku'] ?>"><br><br>

    Giá:
    <input type="number" step="0.01" name="price"
           value="<?= $product['price'] ?>" min="0" required><br><br>

    Tồn kho:
    <input type="number" name="stock"
           value="<?= $product['stock'] ?>" min="0" required><br><br>

    <button type="submit">Cập nhật</button>
</form>

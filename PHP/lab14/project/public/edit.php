<?php
require "../config/database.php";
require "../config/upload.php";

$db = Database::connect();
$id = $_GET['id'];

$product = $db->prepare("SELECT * FROM products WHERE id=?");
$product->execute([$id]);
$p = $product->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagePath = $p['image'];

    if (!empty($_FILES['image']['name'])) {
        $newImage = uploadImage($_FILES['image']);

        // XÓA ẢNH CŨ (trừ ảnh mặc định)
        if ($p['image'] !== 'uploads/default.png' && file_exists($p['image'])) {
            unlink(__DIR__ . "/../public/" . $p['image']);
        }

        $imagePath = $newImage;
    }

    $stmt = $db->prepare(
        "UPDATE products SET name=?, price=?, image=? WHERE id=?"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['price'],
        $imagePath,
        $id
    ]);

    header("Location: index.php");
}
?>

<form method="post" enctype="multipart/form-data">
    Tên: <input name="name" value="<?= $p['name'] ?>"><br>
    Giá: <input name="price" value="<?= $p['price'] ?>"><br>
    Ảnh hiện tại:<br>
    <img src="<?= $p['image'] ?>" width="120"><br>
    Đổi ảnh: <input type="file" name="image"><br>
    <button>Cập nhật</button>
</form>

<?php
require "../config/database.php";
require "../config/upload.php";

function uploadImage($file) {
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
    $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== 0) return null;

    if ($file['size'] > $maxSize) {
        die("File quá lớn (tối đa 2MB)");
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) {
        die("Không cho phép định dạng này");
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMime)) {
        die("File không phải hình ảnh hợp lệ");
    }

    $newName = uniqid() . '.' . $ext;
    $path = "uploads/" . $newName;

    move_uploaded_file($file['tmp_name'], __DIR__ . "/../public/" . $path);

    return $path;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::connect();
    $imagePath = 'uploads/default.png';

    if (!empty($_FILES['image']['name'])) {
        $imagePath = uploadImage($_FILES['image']);
    }

    $stmt = $db->prepare(
        "INSERT INTO products(name, price, image) VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['price'],
        $imagePath
    ]);

    header("Location: index.php");
}
?>

<form method="post" enctype="multipart/form-data">
    Tên: <input name="name" required><br>
    Giá: <input name="price"><br>
    Ảnh: <input type="file" name="image" accept="image/*"><br>
    <button>Thêm</button>
</form>

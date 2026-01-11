<?php
$errors = [];
$data = [
    'code' => '',
    'title' => '',
    'author' => '',
    'year' => '',
    'category' => 'Giáo trình',
    'quantity' => ''
];

$currentYear = date('Y');
$filePath = "../data/books.json";

// Đọc dữ liệu hiện có
$books = [];
if (file_exists($filePath)) {
    $json = file_get_contents($filePath);
    $books = json_decode($json, true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($data as $key => $value) {
        $data[$key] = trim($_POST[$key] ?? '');
    }

    // Validate required
    if ($data['code'] === '') $errors['code'] = "Mã sách không được để trống";
    if ($data['title'] === '') $errors['title'] = "Tên sách không được để trống";
    if ($data['author'] === '') $errors['author'] = "Tác giả không được để trống";
    if ($data['year'] === '') $errors['year'] = "Năm xuất bản không được để trống";
    if ($data['quantity'] === '') $errors['quantity'] = "Số lượng không được để trống";

    // Trùng mã sách
    foreach ($books as $b) {
        if ($b['code'] === $data['code']) {
            $errors['code'] = "Mã sách đã tồn tại";
            break;
        }
    }

    // Validate năm
    if ($data['year'] !== '') {
        if (!is_numeric($data['year']) || $data['year'] < 1900 || $data['year'] > $currentYear) {
            $errors['year'] = "Năm xuất bản phải từ 1900 đến $currentYear";
        }
    }

    // Validate số lượng
    if ($data['quantity'] !== '') {
        if (!is_numeric($data['quantity']) || $data['quantity'] < 0) {
            $errors['quantity'] = "Số lượng phải >= 0";
        }
    }

    // Lưu JSON nếu hợp lệ
    if (empty($errors)) {
        $books[] = $data;
        file_put_contents(
            $filePath,
            json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        header("Location: list_books.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm sách</title>
<style>
body { font-family: Arial; margin: 30px; }
label { display: block; margin-top: 10px; }
.error { color: red; font-size: 14px; }
</style>
</head>
<body>

<h2>Thêm sách vào kho thư viện</h2>

<form method="post">
    <label>
        Mã sách:
        <input type="text" name="code" value="<?= htmlspecialchars($data['code']) ?>">
        <span class="error"><?= $errors['code'] ?? '' ?></span>
    </label>

    <label>
        Tên sách:
        <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>">
        <span class="error"><?= $errors['title'] ?? '' ?></span>
    </label>

    <label>
        Tác giả:
        <input type="text" name="author" value="<?= htmlspecialchars($data['author']) ?>">
        <span class="error"><?= $errors['author'] ?? '' ?></span>
    </label>

    <label>
        Năm xuất bản:
        <input type="number" name="year" value="<?= htmlspecialchars($data['year']) ?>">
        <span class="error"><?= $errors['year'] ?? '' ?></span>
    </label>

    <label>
        Thể loại:
        <select name="category">
            <?php
            $categories = ['Giáo trình','Kỹ năng','Văn học','Khoa học','Khác'];
            foreach ($categories as $c):
            ?>
            <option value="<?= $c ?>" <?= $data['category']===$c?'selected':'' ?>>
                <?= $c ?>
            </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Số lượng:
        <input type="number" name="quantity" value="<?= htmlspecialchars($data['quantity']) ?>">
        <span class="error"><?= $errors['quantity'] ?? '' ?></span>
    </label>

    <br>
    <button type="submit">Thêm sách</button>
    <button type="reset">Reset</button>
</form>

<p><a href="list_books.php">→ Xem danh sách sách</a></p>

</body>
</html>

<?php

if (!isset($_POST['submit'])) {
    echo "Vui lòng quay lại form để nhập dữ liệu.";
    exit;
}

// Hàm validate
function validate($data)
{
    $errors = [];

    // Họ tên
    if (empty(trim($data['full_name'] ?? ''))) {
        $errors[] = "Họ tên không được để trống.";
    }

    // Email
    if (empty($data['email'] ?? '')) {
        $errors[] = "Email không được để trống.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không đúng định dạng.";
    }

    // Tuổi
    if (!isset($data['age']) || $data['age'] === '') {
        $errors[] = "Tuổi không được để trống.";
    } elseif ($data['age'] < 10 || $data['age'] > 80) {
        $errors[] = "Tuổi phải trong khoảng 10–80.";
    }

    // Giới tính
    if (empty($data['gender'] ?? '')) {
        $errors[] = "Vui lòng chọn giới tính.";
    }

    return $errors;
}

$errors = validate($_POST);


if (!empty($errors)) {
    echo "<h3>Danh sách lỗi:</h3>";
    echo "<ul>";
    foreach ($errors as $err) {
        echo "<li>" . htmlspecialchars($err) . "</li>";
    }
    echo "</ul>";
    echo '<a href="form.php">Nhập lại</a>';
    exit;
}

$full_name = htmlspecialchars($_POST['full_name']);
$email     = htmlspecialchars($_POST['email']);
$age       = htmlspecialchars($_POST['age']);
$gender    = htmlspecialchars($_POST['gender']);
$note      = htmlspecialchars($_POST['note'] ?? '');

$hobbies = $_POST['hobbies'] ?? [];
$hobbyText = empty($hobbies)
    ? "Không có"
    : htmlspecialchars(implode(", ", $hobbies));
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả</title>
</head>
<body>

<h2>Thông tin đã nhập</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td>Họ tên</td>
        <td><?= $full_name ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?= $email ?></td>
    </tr>
    <tr>
        <td>Tuổi</td>
        <td><?= $age ?></td>
    </tr>
    <tr>
        <td>Giới tính</td>
        <td><?= $gender ?></td>
    </tr>
    <tr>
        <td>Sở thích</td>
        <td><?= $hobbyText ?></td>
    </tr>
    <tr>
        <td>Ghi chú</td>
        <td><?= $note ?></td>
    </tr>
</table>

<br>
<a href="form.php">Nhập lại</a>

</body>
</html>

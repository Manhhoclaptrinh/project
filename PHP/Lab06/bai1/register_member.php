<?php
// Khởi tạo biến
$errors = [];
$data = [
    'full_name' => '',
    'email' => '',
    'phone' => '',
    'dob' => '',
    'gender' => '',
    'address' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu
    foreach ($data as $key => $value) {
        $data[$key] = trim($_POST[$key] ?? '');
    }

    // Validate required
    if ($data['full_name'] === '') $errors[] = "Họ tên không được để trống";
    if ($data['email'] === '') $errors[] = "Email không được để trống";
    if ($data['phone'] === '') $errors[] = "Số điện thoại không được để trống";
    if ($data['dob'] === '') $errors[] = "Ngày sinh không được để trống";

    // Validate email
    if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không đúng định dạng";
    }

    // Validate phone
    if ($data['phone'] !== '') {
        if (!preg_match('/^[0-9]{9,11}$/', $data['phone'])) {
            $errors[] = "Số điện thoại phải gồm 9–11 chữ số";
        }
    }

    // Nếu hợp lệ -> chuyển sang trang kết quả
    if (empty($errors)) {
        session_start();
        $_SESSION['member'] = $data;
        header("Location: member_result.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng ký thẻ thư viện</title>
<style>
body { font-family: Arial; margin: 30px; }
.error { color: red; }
label { display: block; margin-top: 10px; }
</style>
</head>
<body>

<h2>Đăng ký thẻ thư viện</h2>

<?php if (!empty($errors)): ?>
<div class="error">
    <ul>
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="post">
    <label>
        Họ tên:
        <input type="text" name="full_name" value="<?= htmlspecialchars($data['full_name']) ?>">
    </label>

    <label>
        Email:
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>">
    </label>

    <label>
        Số điện thoại:
        <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
    </label>

    <label>
        Ngày sinh:
        <input type="date" name="dob" value="<?= htmlspecialchars($data['dob']) ?>">
    </label>

    <label>
        Giới tính:
        <input type="radio" name="gender" value="Nam" <?= $data['gender']=='Nam'?'checked':'' ?>> Nam
        <input type="radio" name="gender" value="Nữ" <?= $data['gender']=='Nữ'?'checked':'' ?>> Nữ
        <input type="radio" name="gender" value="Khác" <?= $data['gender']=='Khác'?'checked':'' ?>> Khác
    </label>

    <label>
        Địa chỉ:
        <textarea name="address"><?= htmlspecialchars($data['address']) ?></textarea>
    </label>

    <br>
    <button type="submit">Đăng ký</button>
    <button type="reset">Reset</button>
</form>

</body>
</html>

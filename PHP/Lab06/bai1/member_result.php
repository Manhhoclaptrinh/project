<?php
session_start();
if (!isset($_SESSION['member'])) {
    header("Location: register_member.php");
    exit;
}

$member = $_SESSION['member'];

// Lưu CSV
$file = fopen("../data/members.csv", "a");
fputcsv($file, $member);
fclose($file);

// Xóa session để tránh ghi trùng
unset($_SESSION['member']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Kết quả đăng ký</title>
<style>
body { font-family: Arial; margin: 30px; }
</style>
</head>
<body>

<h2>Đăng ký thành công</h2>

<ul>
    <li>Họ tên: <?= htmlspecialchars($member['full_name']) ?></li>
    <li>Email: <?= htmlspecialchars($member['email']) ?></li>
    <li>Số điện thoại: <?= htmlspecialchars($member['phone']) ?></li>
    <li>Ngày sinh: <?= htmlspecialchars($member['dob']) ?></li>
    <li>Giới tính: <?= htmlspecialchars($member['gender']) ?></li>
    <li>Địa chỉ: <?= nl2br(htmlspecialchars($member['address'])) ?></li>
</ul>

<a href="register_member.php">← Quay lại đăng ký</a>

</body>
</html>

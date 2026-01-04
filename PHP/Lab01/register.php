<?php
$error = "";
$data_submitted = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $hobbies = $_POST["hobbies"] ?? [];

    if ($name === "" || $email === "") {
        $error = "Họ tên và Email không được để trống!";
    } else {
        $data_submitted = true;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form Đăng Ký</title>
</head>
<body>

<h2>Form đăng ký</h2>
<p>Bộ môn Công nghệ Phần mềm, Khoa CNTT, Đại học Công nghệ Đông Á</p>

<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (!$data_submitted): ?>
<form method="POST">
    <label>Họ tên:</label><br>
    <input type="text" name="name"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Giới tính:</label><br>
    <input type="radio" name="gender" value="Nam"> Nam
    <input type="radio" name="gender" value="Nữ"> Nữ
    <input type="radio" name="gender" value="Khác"> Khác
    <br><br>

    <label>Sở thích:</label><br>
    <input type="checkbox" name="hobbies[]" value="Lập trình"> Lập trình<br>
    <input type="checkbox" name="hobbies[]" value="Nghe nhạc"> Nghe nhạc<br>
    <input type="checkbox" name="hobbies[]" value="Chơi game"> Chơi game<br>
    <br>

    <button type="submit">Submit</button>
</form>

<?php else: ?>
<h3>Dữ liệu đã gửi:</h3>
<ul>
    <li>Họ tên: <?php echo htmlspecialchars($name); ?></li>
    <li>Email: <?php echo htmlspecialchars($email); ?></li>
    <li>Giới tính: <?php echo htmlspecialchars($gender); ?></li>
    <li>Sở thích:
        <ul>
            <?php foreach ($hobbies as $h): ?>
                <li><?php echo htmlspecialchars($h); ?></li>
            <?php endforeach; ?>
        </ul>
    </li>
</ul>
<?php endif; ?>

</body>
</html>

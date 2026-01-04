<?php

$fullName = $_GET['fullname'] ?? '';
$height   = $_GET['height'] ?? '';
$weight   = $_GET['weight'] ?? '';

$bmi = null;
$category = '';
$error = '';

// Kiểm tra khi submit (có dữ liệu GET)
if (isset($_GET['fullname'], $_GET['height'], $_GET['weight'])) {

    // Validate dữ liệu
    if ($fullName === '' || $height === '' || $weight === '') {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } elseif (!is_numeric($height) || !is_numeric($weight) || $height <= 0 || $weight <= 0) {
        $error = "Chiều cao và cân nặng phải là số lớn hơn 0.";
    } else {
        // Ép kiểu
        $height = (float)$height;
        $weight = (float)$weight;

        // Tính BMI
        $bmi = round($weight / ($height * $height), 2);

        // Phân loại BMI
        if ($bmi < 18.5) {
            $category = "Gầy";
        } elseif ($bmi < 25) {
            $category = "Bình thường";
        } elseif ($bmi < 30) {
            $category = "Thừa cân";
        } else {
            $category = "Béo phì";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tính BMI</title>
</head>
<body>

<h2>Form tính BMI</h2>

<form method="GET">
    <label>Họ tên:</label><br>
    <input type="text" name="fullname" value="<?= htmlspecialchars($fullName) ?>"><br><br>

    <label>Chiều cao (m):</label><br>
    <input type="text" name="height" value="<?= htmlspecialchars($height) ?>"><br><br>

    <label>Cân nặng (kg):</label><br>
    <input type="text" name="weight" value="<?= htmlspecialchars($weight) ?>"><br><br>

    <button type="submit">Tính BMI</button>
</form>

<br>

<?php if ($error !== ''): ?>
    <p style="color:red;"><strong>Lỗi:</strong> <?= $error ?></p>
<?php endif; ?>

<?php if ($bmi !== null && $error === ''): ?>
    <h3>Kết quả</h3>
    <p>Họ tên: <strong><?= htmlspecialchars($fullName) ?></strong></p>
    <p>BMI: <strong><?= $bmi ?></strong></p>
    <p>Phân loại: <strong><?= $category ?></strong></p>
<?php endif; ?>

</body>
</html>

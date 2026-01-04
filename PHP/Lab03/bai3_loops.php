<?php
$n = isset($_GET["n"]) ? (int)$_GET["n"] : null;

if ($n === null || $n <= 0) {
    echo "Vui lòng truyền tham số n > 0. Ví dụ: ?n=25";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 3 - Vòng lặp</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td, th {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>A) Bảng cửu chương 1–9 (for lồng nhau)</h2>
<table>
    <?php
    for ($i = 1; $i <= 9; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 9; $j++) {
            echo "<td>$i × $j = " . ($i * $j) . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<h2>B) Tính tổng chữ số của n (while)</h2>
<?php
$temp = $n;
$sum = 0;

while ($temp > 0) {
    $sum += $temp % 10;
    $temp = (int)($temp / 10);
}

echo "n = $n → Tổng chữ số = $sum";
?>

<h2>C) Các số lẻ từ 1 đến n (continue & break)</h2>
<?php
for ($i = 1; $i <= $n; $i++) {

    // Bỏ qua số chẵn
    if ($i % 2 == 0) {
        continue;
    }

    // Dừng sớm khi vượt quá 15
    if ($i > 15) {
        break;
    }

    echo $i . " ";
}
?>

</body>
</html>

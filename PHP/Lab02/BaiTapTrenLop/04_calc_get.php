<?php

$a = $_GET['a'] ?? 10;
$b = $_GET['b'] ?? 20;

echo "<h3>Kết quả tính toán</h3>";
echo "<ul>";
echo "<li>Cộng: " . ($a + $b) . "</li>";
echo "<li>Trừ: " . ($a - $b) . "</li>";
echo "<li>Nhân: " . ($a * $b) . "</li>";

if ($b != 0) {
    echo "<li>Chia: " . ($a / $b) . "</li>";
} else {
    echo "<li>Chia: Không thể chia cho 0</li>";
}
echo "</ul>";
?>

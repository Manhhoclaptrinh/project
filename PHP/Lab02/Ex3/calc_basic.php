<?php

// Khai báo biến
$a = 10;
$b = 3;

// Tính toán
$sum = $a + $b;        
$diff = $a - $b;       
$product = $a * $b;    
$quotient = $a / $b;   
$remainder = $a % $b;  

// In kết quả các phép toán
echo "Tong: " . $a . " + " . $b . " = " . $sum . "<br>";
echo "Hieu: " . $a . " - " . $b . " = " . $diff . "<br>";
echo "Tich: " . $a . " * " . $b . " = " . $product . "<br>";
echo "Thuong: " . $a . " / " . $b . " = " . $quotient . "<br>";
echo "Du: " . $a . " % " . $b . " = " . $remainder . "<br><br>";

$message = "Ket qua phep tinh: ";
$message .= "Tong = " . $sum . ", ";
$message .= "Hieu = " . $diff;
echo $message . "<br><br>";

var_dump("5" == 5);
echo "<br>";
var_dump("5" === 5);
echo "<br>";

/*
Giải thích:
- "5" == 5  → true vì PHP tự ép kiểu khi so sánh giá trị.
- "5" === 5 → false vì khác kiểu dữ liệu (string !== int).
*/
?>

<?php
// Nhận dữ liệu từ URL
$a  = isset($_GET["a"]) ? (float)$_GET["a"] : null;
$b  = isset($_GET["b"]) ? (float)$_GET["b"] : null;
$op = $_GET["op"] ?? null;

// Kiểm tra đủ tham số
if ($a === null || $b === null || $op === null) {
    echo "Vui lòng truyền đủ tham số a, b và op.";
    exit;
}

$result = null;
$symbol = "";

// Xử lý phép toán
switch ($op) {
    case "add":
        $result = $a + $b;
        $symbol = "+";
        break;

    case "sub":
        $result = $a - $b;
        $symbol = "-";
        break;

    case "mul":
        $result = $a * $b;
        $symbol = "*";
        break;

    case "div":
        if ($b == 0) {
            echo "Không chia được cho 0";
            exit;
        }
        $result = $a / $b;
        $symbol = "/";
        break;

    default:
        echo "Phép toán không hợp lệ. Chỉ hỗ trợ add, sub, mul, div.";
        exit;
}

// Hiển thị kết quả
echo "$a $symbol $b = $result";
?>

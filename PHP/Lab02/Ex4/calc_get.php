<?php

if (!isset($_GET['a']) || !isset($_GET['b']) || !isset($_GET['op'])) {
    echo "Thiếu tham số!<br>";
    echo "Cách dùng:<br>";
    echo "calc_get.php?a=10&b=3&op=add<br>";
    echo "op gồm: add | sub | mul | div";
    exit;
}

$a = (float) $_GET['a'];
$b = (float) $_GET['b'];
$op = $_GET['op'];

$result = null;
$operatorSymbol = "";

switch ($op) {
    case "add":
        $result = $a + $b;
        $operatorSymbol = "+";
        break;

    case "sub":
        $result = $a - $b;
        $operatorSymbol = "-";
        break;

    case "mul":
        $result = $a * $b;
        $operatorSymbol = "*";
        break;

    case "div":
        if ($b == 0) {
            echo "Lỗi: Không thể chia cho 0";
            exit;
        }
        $result = $a / $b;
        $operatorSymbol = "/";
        break;

    default:
        echo "Phép toán không hợp lệ. Chỉ chấp nhận: add | sub | mul | div";
        exit;
}

echo $a . " " . $operatorSymbol . " " . $b . " = " . $result;
?>

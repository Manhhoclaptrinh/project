<?php
require_once "functions.php";

$action = $_GET['action'] ?? '';

echo "<h2>Mini Utility</h2>";

switch ($action) {

    case 'prime':
        $n = $_GET['n'] ?? 0;
        if (isPrime($n)) {
            echo "$n là số nguyên tố";
        } else {
            echo "$n không phải là số nguyên tố";
        }
        break;

    case 'fact':
        $n = $_GET['n'] ?? 0;
        echo "Giai thừa của $n là: " . factorial($n);
        break;

    case 'gcd':
        $a = $_GET['a'] ?? 0;
        $b = $_GET['b'] ?? 0;
        echo "ƯCLN của $a và $b là: " . gcd($a, $b);
        break;

    default:
        echo "<ul>
                <li><a href='?action=prime&n=17'>Kiểm tra số nguyên tố</a></li>
                <li><a href='?action=fact&n=6'>Tính giai thừa</a></li>
                <li><a href='?action=gcd&a=128&b=18'>Tìm ƯCLN</a></li>
              </ul>";
}
?>

<?php
//Hàm số lớn nhất
function findMax($a, $b) {
    return ($a > $b) ? $a : $b;
}

//Hàm số nhỏ nhất
function findMin($a, $b) {
    return ($a < $b) ? $a : $b;
}

//Kiểm tra số nguyên tố
function isPrime($num) {
    if ($num < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

//Tính giai thừa
function factorial($n) {
    $result = 1;
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

//Tìm ước số chung lớn nhất
function gcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}
?>

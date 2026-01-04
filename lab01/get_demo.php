<?php
if (isset($_GET['name']) && isset($_GET['age'])) {
    $name = htmlspecialchars($_GET['name']);
    $age  = htmlspecialchars($_GET['age']);

    echo "Xin chào {$name}, tuổi: {$age}";
} else {
    echo "Thiếu tham số.<br>";
    echo "Vui lòng cung cấp cả 'name' và 'age' trong URL.<br>";}
?>

<?php

// Khai báo biến
$fullName = "Đoàn Quang Mạnh";
$age = 20;                 
$gpa = 2.62;               
$isActive = true;          

// Khai báo hằng
const SCHOOL = "ABC University";

// Hiển thị thông tin
echo "Ho ten: $fullName <br>";
echo "Tuoi: $age <br>";
echo "Diem GPA: $gpa <br>";
echo "Trang thai hoat dong: $isActive <br>";
echo "Truong: " . SCHOOL . "<br><br>";

// Hiển thị thông tin dạng debug 
var_dump($fullName);
echo "<br>";
var_dump($age);
echo "<br>";
var_dump($gpa);
echo "<br>";
var_dump($isActive);
echo "<br>";
var_dump(SCHOOL);
echo "<br><br>";

// Thử nội suy chuỗi
echo "Nháy kép: Tuoi: $age <br>";
echo 'Nháy đơn: Tuoi: $age <br>';

/*
Nhận xét:
- Nháy kép (" ") có nội suy biến, nên $age được thay bằng giá trị thực (20).
- Nháy đơn (' ') không nội suy biến, nên in ra nguyên chuỗi "$age".
*/
?>

<?php
require_once "Student.php";

// Tạo hàm escape HTML
function h($s)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

// Tạo danh sách sinh viên
$students = [
    new Student("SV01", "Nguyễn Văn A", 3.4),
    new Student("SV02", "Trần Thị B", 2.8),
    new Student("SV03", "Lê Văn C", 2.3),
    new Student("SV04", "Phạm Thị D", 3.6),
    new Student("SV05", "Hoàng Văn E", 2.9),
];

// Tính GPA trung bình lớp
$gpas = array_map(function ($st) {
    return $st->getGpa();
}, $students);

$avgGpa = array_sum($gpas) / count($gpas);

// Thống kê xếp loại
$rankStats = [
    'Giỏi' => 0,
    'Khá' => 0,
    'Trung bình' => 0
];

foreach ($students as $st) {
    $rankStats[$st->rank()]++;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 4 - OOP Student</title>
    <style>
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #333; padding: 6px 10px; }
        th { background: #f2f2f2; }
        td.center { text-align: center; }
    </style>
</head>
<body>

<h2>Bài 4 — OOP Student + render + thống kê xếp loại</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Name</th>
            <th>GPA</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $i => $st): ?>
            <tr>
                <td class="center"><?= $i + 1 ?></td>
                <td><?= h($st->getId()) ?></td>
                <td><?= h($st->getName()) ?></td>
                <td class="center"><?= number_format($st->getGpa(), 2) ?></td>
                <td><?= $st->rank() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Thống kê</h3>
<p><strong>GPA trung bình lớp:</strong> <?= number_format($avgGpa, 2) ?></p>

<ul>
    <li>Giỏi: <?= $rankStats['Giỏi'] ?></li>
    <li>Khá: <?= $rankStats['Khá'] ?></li>
    <li>Trung bình: <?= $rankStats['Trung bình'] ?></li>
</ul>

</body>
</html>

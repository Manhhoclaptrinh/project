<?php
// Khai báo mảng 
$scores = [8.5, 7.0, 9.25, 6.5, 8.0, 5.75];

// Tính điểm trung bình
$avg = array_sum($scores) / count($scores);

// Lọc các điểm >= 8.0
$highScores = array_filter($scores, function ($score) {
    return $score >= 8.0;
});

// Tìm điểm cao nhất và thấp nhất
$maxScore = max($scores);
$minScore = min($scores);

// Sắp xếp tăng và giảm 
$ascScores = $scores;
$descScores = $scores;

sort($ascScores);   
rsort($descScores);  
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Thống kê mảng điểm</title>
</head>
<body>

<h2>Bài 2 — Mảng điểm: thống kê + sắp xếp</h2>

<p><strong>Mảng điểm ban đầu:</strong>
    <?= htmlspecialchars(implode(', ', $scores)) ?>
</p>

<p><strong>Điểm trung bình:</strong>
    <?= number_format($avg, 2) ?>
</p>

<p><strong>Số lượng điểm ≥ 8.0:</strong>
    <?= count($highScores) ?>
</p>

<p><strong>Các điểm ≥ 8.0:</strong>
    <?= htmlspecialchars(implode(', ', $highScores)) ?>
</p>

<p><strong>Điểm cao nhất:</strong> <?= $maxScore ?></p>
<p><strong>Điểm thấp nhất:</strong> <?= $minScore ?></p>

<p><strong>Sắp xếp tăng dần:</strong>
    <?= htmlspecialchars(implode(', ', $ascScores)) ?>
</p>

<p><strong>Sắp xếp giảm dần:</strong>
    <?= htmlspecialchars(implode(', ', $descScores)) ?>
</p>

</body>
</html>

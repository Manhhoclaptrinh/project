<?php
// Nhận dữ liệu từ GET (URL)
$score = isset($_GET["score"]) ? $_GET["score"] : null;

// Kiểm tra có truyền tham số hay chưa
if ($score === null) {
    echo "Hãy truyền tham số ?score=...";
    exit;
}

// Ép kiểu số
$score = (float)$score;

// Kiểm tra hợp lệ: 0 ≤ score ≤ 10
if ($score < 0 || $score > 10) {
    echo "Điểm không hợp lệ. Vui lòng nhập điểm từ 0 đến 10.";
    exit;
}

// Phân loại điểm
if ($score >= 8.5) {
    $rank = "Giỏi";
} elseif ($score >= 7.0) {
    $rank = "Khá";
} elseif ($score >= 5.0) {
    $rank = "Trung bình";
} else {
    $rank = "Yếu";
}

// Hiển thị kết quả
echo "Điểm: $score – Xếp loại: $rank";
?>

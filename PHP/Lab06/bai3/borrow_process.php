<?php
$errors = [];

$bookCode   = trim($_POST['book_code'] ?? '');
$borrowDate = $_POST['borrow_date'] ?? '';
$days       = (int)($_POST['days'] ?? 0);

$books = json_decode(file_get_contents("../data/books.json"), true) ?? [];
$bookIndex = -1;

foreach ($books as $i => $b) {
    if ($b['code'] === $bookCode) {
        $bookIndex = $i;
        break;
    }
}

if ($bookIndex === -1) {
    $errors[] = "Mã sách không tồn tại";
} elseif ($books[$bookIndex]['quantity'] <= 0) {
    $errors[] = "Sách đã hết, không thể mượn";
}

if ($days < 1 || $days > 30) {
    $errors[] = "Số ngày mượn phải từ 1 đến 30";
}

if (!empty($errors)) {
    echo "<h3>Lỗi:</h3><ul>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul><a href='borrow_form.php'>Quay lại</a>";
    exit;
}

$borrowsFile = "../data/borrows.json";
$borrows = json_decode(file_get_contents($borrowsFile), true) ?? [];

$borrowId = "PM" . time();
$dueDate = date("Y-m-d", strtotime("$borrowDate +$days days"));

$record = [
    'borrow_id'   => $borrowId,
    'book_code'   => $bookCode,
    'borrow_date' => $borrowDate,
    'due_date'    => $dueDate,
    'status'      => 'Đang mượn'
];

$borrows[] = $record;
file_put_contents($borrowsFile, json_encode($borrows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

$books[$bookIndex]['quantity']--;
file_put_contents("../data/books.json", json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "<h3>Lập phiếu mượn thành công</h3>";
echo "<pre>"; print_r($record); echo "</pre>";
echo "<a href='borrow_form.php'>Mượn tiếp</a>";

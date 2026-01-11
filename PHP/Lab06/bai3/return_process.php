<?php
$borrowId   = trim($_POST['borrow_id'] ?? '');
$returnDate = $_POST['return_date'] ?? '';

$borrowsFile = "../data/borrows.json";
$borrows = json_decode(file_get_contents($borrowsFile), true) ?? [];

$foundIndex = -1;

foreach ($borrows as $i => $b) {
    if ($b['borrow_id'] === $borrowId && $b['status'] === 'Đang mượn') {
        $foundIndex = $i;
        break;
    }
}

if ($foundIndex === -1) {
    echo "Phiếu không tồn tại hoặc đã trả<br>";
    echo "<a href='return_form.php'>Quay lại</a>";
    exit;
}

$borrows[$foundIndex]['status'] = 'Đã trả';
$borrows[$foundIndex]['return_date'] = $returnDate;

file_put_contents($borrowsFile, json_encode($borrows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

$books = json_decode(file_get_contents("../data/books.json"), true) ?? [];
foreach ($books as &$book) {
    if ($book['code'] === $borrows[$foundIndex]['book_code']) {
        $book['quantity']++;
        break;
    }
}
file_put_contents("../data/books.json", json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "<h3>Trả sách thành công</h3>";
echo "<pre>"; print_r($borrows[$foundIndex]); echo "</pre>";
echo "<a href='return_form.php'>Trả tiếp</a>";

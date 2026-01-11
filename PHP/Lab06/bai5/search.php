<?php
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$jsonPath = __DIR__ . '/books.json';

$books = [];
if (file_exists($jsonPath)) {
    $books = json_decode(file_get_contents($jsonPath), true);
}

// Lấy dữ liệu từ GET
$kw         = trim($_GET['kw'] ?? '');
$category   = $_GET['category'] ?? 'all';
$year_from  = $_GET['year_from'] ?? '';
$year_to    = $_GET['year_to'] ?? '';

$results = $books;

if (!empty($_GET)) {
    $results = [];

    foreach ($books as $book) {

        // keyword
        if ($kw !== '') {
            if (
                stripos($book['title'], $kw) === false &&
                stripos($book['author'], $kw) === false
            ) continue;
        }

        // category
        if ($category !== 'all' && $book['category'] !== $category) {
            continue;
        }

        // year from
        if ($year_from !== '' && $book['year'] < (int)$year_from) {
            continue;
        }

        // year to
        if ($year_to !== '' && $book['year'] > (int)$year_to) {
            continue;
        }

        $results[] = $book;
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Tìm kiếm sách</title>
<style>
body { font-family: Arial; margin: 30px; }
form { margin-bottom: 20px; }
input, select { padding: 6px; margin-right: 10px; }
table { border-collapse: collapse; width: 100%; }
th, td { border: 1px solid #ccc; padding: 8px; }
th { background: #f0f0f0; }
.no-result { color: red; font-weight: bold; }
</style>
</head>
<body>

<h2>Tìm kiếm sách</h2>

<form method="get" action="search.php">
    Từ khóa:
    <input type="text" name="kw" value="<?= e($kw) ?>">

    Thể loại:
    <select name="category">
        <option value="all">-- Tất cả --</option>
        <option value="IT" <?= $category === 'IT' ? 'selected' : '' ?>>IT</option>
        <option value="Economy" <?= $category === 'Economy' ? 'selected' : '' ?>>Kinh tế</option>
        <option value="Business" <?= $category === 'Business' ? 'selected' : '' ?>>Kinh doanh</option>
    </select>

    Năm từ:
    <input type="number" name="year_from" value="<?= e($year_from) ?>" style="width:90px">

    đến:
    <input type="number" name="year_to" value="<?= e($year_to) ?>" style="width:90px">

    <button type="submit">Search</button>
</form>

<?php if (!empty($_GET)): ?>
    <?php if (count($results) === 0): ?>
        <p class="no-result">Không tìm thấy kết quả phù hợp.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Thể loại</th>
                <th>Năm</th>
                <th>Giá (VNĐ)</th>
            </tr>
            <?php foreach ($results as $b): ?>
            <tr>
                <td><?= e($b['id']) ?></td>
                <td><?= e($b['title']) ?></td>
                <td><?= e($b['author']) ?></td>
                <td><?= e($b['category']) ?></td>
                <td><?= e($b['year']) ?></td>
                <td><?= number_format($b['price']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>

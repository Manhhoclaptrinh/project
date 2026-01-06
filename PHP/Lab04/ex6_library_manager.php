<?php
require_once "Book.php";

function h($s)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

$books = [];
$error = '';
$stats = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = trim($_POST['data'] ?? '');
    $q = trim($_POST['q'] ?? '');
    $sortDesc = isset($_POST['sort_qty_desc']);

    if ($raw === '') {
        $error = "Vui lòng nhập dữ liệu sách.";
    } else {
        // Parse dữ liệu
        $records = explode(';', $raw);

        foreach ($records as $rec) {
            $rec = trim($rec);
            if ($rec === '') continue;

            $parts = explode('-', $rec);
            if (count($parts) !== 3) continue;

            [$id, $title, $qtyStr] = $parts;

            if ($id === '' || $title === '' || !is_numeric($qtyStr)) {
                continue;
            }

            $books[] = new Book($id, $title, $qtyStr);
        }

        if (empty($books)) {
            $error = "Không có dữ liệu sách hợp lệ.";
        } else {
            // Tìm theo Title
            if ($q !== '') {
                $books = array_filter($books, function ($b) use ($q) {
                    return stripos($b->getTitle(), $q) !== false;
                });
            }

            if (empty($books)) {
                $error = "Không tìm thấy sách phù hợp.";
            } else {
                // Sort Qty giảm dần
                if ($sortDesc) {
                    usort($books, function ($a, $b) {
                        return $b->getQty() <=> $a->getQty();
                    });
                }

                // Thống kê
                $totalTitles = count($books);
                $totalQty = 0;
                $maxQtyBook = null;
                $outOfStock = 0;

                foreach ($books as $b) {
                    $totalQty += $b->getQty();

                    if ($maxQtyBook === null || $b->getQty() > $maxQtyBook->getQty()) {
                        $maxQtyBook = $b;
                    }

                    if ($b->getQty() === 0) {
                        $outOfStock++;
                    }
                }

                $stats = [
                    'totalTitles' => $totalTitles,
                    'totalQty' => $totalQty,
                    'maxQtyBook' => $maxQtyBook,
                    'outOfStock' => $outOfStock
                ];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Library Manager</title>
    <style>
        textarea { width: 80%; height: 80px; }
        table { border-collapse: collapse; width: 85%; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px 10px; }
        th { background: #f2f2f2; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>6A — Quản lý thư viện mini (Library Manager)</h2>

<form method="post">
    <p>
        <label>Dữ liệu sách:</label><br>
        <textarea name="data"><?= h($_POST['data'] ?? '') ?></textarea>
    </p>

    <p>
        <label>Tìm theo Title:</label>
        <input type="text" name="q" value="<?= h($_POST['q'] ?? '') ?>">
    </p>

    <p>
        <label>
            <input type="checkbox" name="sort_qty_desc" <?= isset($_POST['sort_qty_desc']) ? 'checked' : '' ?>>
            Sort Qty giảm dần
        </label>
    </p>

    <button type="submit">Parse & Show</button>
</form>

<?php if ($error): ?>
    <p class="error"><?= h($error) ?></p>
<?php endif; ?>

<?php if (!empty($books) && $stats): ?>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>BookID</th>
                <th>Title</th>
                <th>Qty</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $i => $b): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= h($b->getId()) ?></td>
                    <td><?= h($b->getTitle()) ?></td>
                    <td><?= $b->getQty() ?></td>
                    <td><?= $b->getStatus() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Thống kê</h3>
    <ul>
        <li>Tổng đầu sách: <?= $stats['totalTitles'] ?></li>
        <li>Tổng số quyển: <?= $stats['totalQty'] ?></li>
        <li>Sách có số lượng lớn nhất:
            <?= h($stats['maxQtyBook']->getTitle()) ?>
            (<?= $stats['maxQtyBook']->getQty() ?>)
        </li>
        <li>Số sách Out of stock: <?= $stats['outOfStock'] ?></li>
    </ul>
<?php endif; ?>

</body>
</html>

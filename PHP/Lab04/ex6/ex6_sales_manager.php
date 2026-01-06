<?php
require_once "Product.php";

function h($s)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

$products = [];
$error = '';
$stats = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = trim($_POST['data'] ?? '');
    $minPrice = $_POST['minPrice'] ?? '';
    $sortAmountDesc = isset($_POST['sort_amount_desc']);

    if ($raw === '') {
        $error = "Vui lòng nhập dữ liệu sản phẩm.";
    } else {
        // Parse dữ liệu
        $records = explode(';', $raw);

        foreach ($records as $rec) {
            $rec = trim($rec);
            if ($rec === '') continue;

            $parts = explode('-', $rec);
            if (count($parts) !== 4) continue;

            [$id, $name, $priceStr, $qtyStr] = $parts;

            if (
                $id === '' ||
                $name === '' ||
                !is_numeric($priceStr) ||
                !is_numeric($qtyStr)
            ) {
                continue;
            }

            $products[] = new Product($id, $name, $priceStr, $qtyStr);
        }

        if (empty($products)) {
            $error = "Không có dữ liệu sản phẩm hợp lệ.";
        } else {
            // Filter theo minPrice
            if ($minPrice !== '' && is_numeric($minPrice)) {
                $products = array_filter($products, function ($p) use ($minPrice) {
                    return $p->getPrice() >= $minPrice;
                });
            }

            if (empty($products)) {
                $error = "Không có sản phẩm nào thỏa điều kiện lọc.";
            } else {
                // Sort Amount giảm dần
                if ($sortAmountDesc) {
                    usort($products, function ($a, $b) {
                        return $b->amount() <=> $a->amount();
                    });
                }

                // Thống kê
                $totalAmount = 0;
                $sumPrice = 0;
                $maxAmountProduct = null;

                foreach ($products as $p) {
                    if ($p->isValidQty()) {
                        $totalAmount += $p->amount();
                    }
                    $sumPrice += $p->getPrice();

                    if (
                        $maxAmountProduct === null ||
                        $p->amount() > $maxAmountProduct->amount()
                    ) {
                        $maxAmountProduct = $p;
                    }
                }

                $stats = [
                    'totalAmount' => $totalAmount,
                    'avgPrice' => $sumPrice / count($products),
                    'maxAmountProduct' => $maxAmountProduct
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
    <title>Mini Sales Manager</title>
    <style>
        textarea { width: 80%; height: 80px; }
        table { border-collapse: collapse; width: 90%; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px 10px; }
        th { background: #f2f2f2; }
        .error { color: red; font-weight: bold; }
        .invalid { color: red; font-style: italic; }
    </style>
</head>
<body>

<h2>6B — Quản lý bán hàng mini (Mini Sales Manager)</h2>

<form method="post">
    <p>
        <label>Dữ liệu sản phẩm:</label><br>
        <textarea name="data"><?= h($_POST['data'] ?? '') ?></textarea>
    </p>

    <p>
        <label>Min Price ≥ </label>
        <input type="text" name="minPrice" value="<?= h($_POST['minPrice'] ?? '') ?>">
    </p>

    <p>
        <label>
            <input type="checkbox" name="sort_amount_desc" <?= isset($_POST['sort_amount_desc']) ? 'checked' : '' ?>>
            Sort Amount giảm dần
        </label>
    </p>

    <button type="submit">Parse & Show</button>
</form>

<?php if ($error): ?>
    <p class="error"><?= h($error) ?></p>
<?php endif; ?>

<?php if (!empty($products) && $stats): ?>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $i => $p): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= h($p->getId()) ?></td>
                    <td><?= h($p->getName()) ?></td>
                    <td><?= number_format($p->getPrice(), 2) ?></td>
                    <td>
                        <?php if ($p->isValidQty()): ?>
                            <?= $p->getQty() ?>
                        <?php else: ?>
                            <span class="invalid">Invalid qty</span>
                        <?php endif; ?>
                    </td>
                    <td><?= number_format($p->amount(), 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Thống kê</h3>
    <ul>
        <li>Tổng tiền: <?= number_format($stats['totalAmount'], 2) ?></li>
        <li>Giá trung bình (avg price): <?= number_format($stats['avgPrice'], 2) ?></li>
        <li>Sản phẩm có amount lớn nhất:
            <?= h($stats['maxAmountProduct']->getName()) ?>
            (<?= number_format($stats['maxAmountProduct']->amount(), 2) ?>)
        </li>
    </ul>
<?php endif; ?>

</body>
</html>

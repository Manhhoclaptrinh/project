<?php
// Tạo hàm escape khi render HTML
function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

// Tạo mảng sản phẩm
$products = [
    ['name' => 'Bút bi',     'price' => 5000,  'qty' => 10],
    ['name' => 'Vở A5',      'price' => 12000, 'qty' => 5],
    ['name' => 'Thước kẻ',   'price' => 8000,  'qty' => 3],
    ['name' => 'Tập giấy',   'price' => 25000, 'qty' => 2],
];

// Tạo cột amount = price * qty
$productsWithAmount = array_map(function ($p) {
    $p['amount'] = $p['price'] * $p['qty'];
    return $p;
}, $products);

// Tính tổng tiền đơn hàng
$totalAmount = array_reduce($productsWithAmount, function ($sum, $p) {
    return $sum + $p['amount'];
}, 0);

// Tìm sản phẩm có amount lớn nhất
$maxProduct = array_reduce($productsWithAmount, function ($max, $p) {
    if ($max === null || $p['amount'] > $max['amount']) {
        return $p;
    }
    return $max;
}, null);

// Sắp xếp theo price giảm dần (không làm mất mảng gốc)
$sortedByPriceDesc = $productsWithAmount;
usort($sortedByPriceDesc, function ($a, $b) {
    return $b['price'] <=> $a['price'];
});
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 3 - Giỏ hàng</title>
    <style>
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #333; padding: 6px 10px; text-align: right; }
        th { background: #f2f2f2; }
        td.name { text-align: left; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>

<h2>Bài 3 — Giỏ hàng: mảng nhiều chiều + tổng tiền + sort</h2>

<h3>Danh sách sản phẩm</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productsWithAmount as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td class="name"><?= h($p['name']) ?></td>
                <td><?= number_format($p['price']) ?></td>
                <td><?= $p['qty'] ?></td>
                <td><?= number_format($p['amount']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">Tổng tiền</td>
            <td><?= number_format($totalAmount) ?></td>
        </tr>
    </tfoot>
</table>

<h3>Sản phẩm có amount lớn nhất</h3>
<p>
    <?= h($maxProduct['name']) ?> —
    Amount: <?= number_format($maxProduct['amount']) ?>
</p>

<h3>Danh sách sau khi sắp xếp theo price giảm dần</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sortedByPriceDesc as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td class="name"><?= h($p['name']) ?></td>
                <td><?= number_format($p['price']) ?></td>
                <td><?= $p['qty'] ?></td>
                <td><?= number_format($p['amount']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

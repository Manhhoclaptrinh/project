<?php
session_start();

$errors = [];
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ====== LẤY DỮ LIỆU KHÁCH ======
    $customer_name  = trim($_POST['customer_name']);
    $email          = trim($_POST['email']);
    $phone          = trim($_POST['phone']);
    $payment        = $_POST['payment'] ?? '';

    if ($customer_name === '') $errors[] = "Họ tên không được rỗng";
    if ($phone === '') $errors[] = "Số điện thoại là bắt buộc";

    // ====== LẤY DỮ LIỆU HÀNG HÓA ======
    $items = [];
    $subtotal = 0;

    for ($i = 0; $i < 3; $i++) {
        $name  = trim($_POST['item_name'][$i]);
        $qty   = (int)$_POST['qty'][$i];
        $price = (float)$_POST['price'][$i];

        if ($name !== '' && $qty > 0 && $price > 0) {
            $total = $qty * $price;
            $subtotal += $total;

            $items[] = [
                'name' => $name,
                'qty' => $qty,
                'price' => $price,
                'total' => $total
            ];
        }
    }

    if (count($items) === 0) {
        $errors[] = "Phải có ít nhất 1 dòng hàng hợp lệ";
    }

    // ====== GIẢM GIÁ & VAT ======
    $discount_percent = min(max((int)$_POST['discount'], 0), 30);
    $vat_percent      = min(max((int)$_POST['vat'], 0), 15);

    $discount_amount = $subtotal * $discount_percent / 100;
    $vat_amount      = ($subtotal - $discount_amount) * $vat_percent / 100;
    $grand_total     = $subtotal - $discount_amount + $vat_amount;

    // ====== NẾU KHÔNG LỖI → LƯU FILE ======
    if (!$errors) {
        $invoice = [
            'customer' => [
                'name' => $customer_name,
                'email' => $email,
                'phone' => $phone
            ],
            'items' => $items,
            'discount_percent' => $discount_percent,
            'vat_percent' => $vat_percent,
            'subtotal' => $subtotal,
            'discount' => $discount_amount,
            'vat' => $vat_amount,
            'total' => $grand_total,
            'payment' => $payment,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $filename = 'data/invoices/invoice_' . time() . '.json';
        file_put_contents($filename, json_encode($invoice, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $result = $invoice;
        $_SESSION['old'] = null;
    } else {
        $_SESSION['old'] = $_POST;
    }
}

$old = $_SESSION['old'] ?? [];
function old($name, $index = null) {
    global $old;
    return $index === null ? ($old[$name] ?? '') : ($old[$name][$index] ?? '');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hóa đơn bán hàng mini</title>
<style>
body { font-family: Arial; background: #f4f6f8; }
.container { width: 800px; margin: 30px auto; background: #fff; padding: 20px; }
input, select { padding: 6px; width: 100%; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
.error { color: red; }
.total { text-align: right; font-weight: bold; }
</style>
</head>

<body>
<div class="container">
<h2>HÓA ĐƠN BÁN HÀNG MINI</h2>

<?php foreach ($errors as $e): ?>
    <div class="error">• <?= $e ?></div>
<?php endforeach; ?>

<form method="post">
<h3>Thông tin khách hàng</h3>
<input name="customer_name" placeholder="Họ tên" value="<?= old('customer_name') ?>">
<input name="email" placeholder="Email (tùy chọn)" value="<?= old('email') ?>">
<input name="phone" placeholder="Số điện thoại *" value="<?= old('phone') ?>">

<h3>Danh sách hàng hóa</h3>
<table>
<tr>
<th>Tên hàng</th><th>Số lượng</th><th>Đơn giá</th>
</tr>
<?php for ($i=0;$i<3;$i++): ?>
<tr>
<td><input name="item_name[]" value="<?= old('item_name',$i) ?>"></td>
<td><input type="number" name="qty[]" value="<?= old('qty',$i) ?>"></td>
<td><input type="number" name="price[]" value="<?= old('price',$i) ?>"></td>
</tr>
<?php endfor; ?>
</table>

<h3>Thanh toán</h3>
Giảm giá (%): <input type="number" name="discount" value="<?= old('discount') ?>">
VAT (%): <input type="number" name="vat" value="<?= old('vat') ?>">

<br><br>
<input type="radio" name="payment" value="Tiền mặt" checked> Tiền mặt
<input type="radio" name="payment" value="Chuyển khoản"> Chuyển khoản

<br><br>
<button type="submit">Tạo hóa đơn</button>
</form>

<?php if ($result): ?>
<hr>
<h3>CHI TIẾT HÓA ĐƠN</h3>
<table>
<tr><th>Mặt hàng</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th></tr>
<?php foreach ($result['items'] as $it): ?>
<tr>
<td><?= $it['name'] ?></td>
<td><?= $it['qty'] ?></td>
<td><?= number_format($it['price']) ?> đ</td>
<td><?= number_format($it['total']) ?> đ</td>
</tr>
<?php endforeach; ?>
</table>

<p class="total">Tạm tính: <?= number_format($result['subtotal']) ?> đ</p>
<p class="total">Giảm giá: <?= number_format($result['discount']) ?> đ</p>
<p class="total">VAT: <?= number_format($result['vat']) ?> đ</p>
<p class="total">TỔNG THANH TOÁN: <?= number_format($result['total']) ?> đ</p>
<?php endif; ?>

</div>
</body>
</html>

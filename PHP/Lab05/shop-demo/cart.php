<?php
require_once 'includes/auth.php';
require_login();
require_once 'includes/header.php';

$products = [
    1 => ['name' => 'Laptop', 'price' => 1500],
    2 => ['name' => 'Mouse', 'price' => 20],
    3 => ['name' => 'Keyboard', 'price' => 50]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear'])) {
        unset($_SESSION['cart']);
    } elseif (isset($_POST['remove'])) {
        unset($_SESSION['cart'][$_POST['remove']]);
    }
}
?>

<h2>Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>
<p>Cart trống</p>
<?php else: ?>
<ul>
<?php foreach ($_SESSION['cart'] as $id => $qty): ?>
<li>
<?= htmlspecialchars($products[$id]['name']) ?> x <?= $qty ?>
<form method="post" style="display:inline">
<button name="remove" value="<?= $id ?>">Xóa</button>
</form>
</li>
<?php endforeach; ?>
</ul>

<form method="post">
<button name="clear">Xóa toàn bộ</button>
</form>
<?php endif; ?>

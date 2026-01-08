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
    $id = (int)$_POST['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}
?>

<h2>Products</h2>

<?php foreach ($products as $id => $p): ?>
<form method="post">
    <?= htmlspecialchars($p['name']) ?> - $<?= $p['price'] ?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <button>Add</button>
</form>
<?php endforeach; ?>

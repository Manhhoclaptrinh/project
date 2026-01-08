<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/flash.php';
require_once __DIR__ . '/csrf.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Shop Demo</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<?php if ($msg = get_flash()): ?>
<div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<nav class="mb-3">
<a href="dashboard.php">Dashboard</a> |
<a href="products.php">Products</a> |
<a href="cart.php">Cart</a>
<?php if (current_user()['role'] === 'admin'): ?>
 | <strong>Admin Panel</strong>
<?php endif; ?>
</nav>
</body>
</html>

<?php
$db = Database::connect();
$stmt = $db->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$_GET['id']]);
$p = $stmt->fetch();
?>

<h2><?= $p['name'] ?></h2>
<img src="<?= $p['image'] ?>" width="400"><br>
Giá: <?= $p['price'] ?>

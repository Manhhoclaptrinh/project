<?php
require_once 'includes/auth.php';
require_once 'includes/flash.php';
require_login();
require_once 'includes/header.php';
?>

<h2>Dashboard</h2>
<p>Xin chào <strong><?= htmlspecialchars(current_user()['username']) ?></strong></p>

<form method="post" action="logout.php">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <button class="btn btn-danger">Logout</button>
</form>

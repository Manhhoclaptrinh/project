<?php
require_once 'includes/auth.php';
require_once 'includes/csrf.php';
require_once 'includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf'])) {
    $u = $_SESSION['user']['username'];

    session_destroy();
    setcookie('remember_username', '', time() - 3600, '/');

    file_put_contents('data/log.txt',
        date('Y-m-d H:i:s') . " LOGOUT $u\n", FILE_APPEND);

    session_start();
    set_flash("Bạn đã đăng xuất");
}

header("Location: login.php");
exit();

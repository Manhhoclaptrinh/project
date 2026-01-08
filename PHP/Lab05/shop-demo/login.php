<?php
require_once 'includes/auth.php';
require_once 'includes/flash.php';

$users = require 'data/users.php';
$username_cookie = $_COOKIE['remember_username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    if (isset($users[$u]) && password_verify($p, $users[$u]['password'])) {
        $_SESSION['user'] = [
            'username' => $u,
            'role' => $users[$u]['role']
        ];

        if (!empty($_POST['remember'])) {
            setcookie('remember_username', $u, time() + 7*24*3600, '/');
        }

        file_put_contents('data/log.txt',
            date('Y-m-d H:i:s') . " LOGIN $u\n", FILE_APPEND);

        set_flash("Đăng nhập thành công");
        header("Location: dashboard.php");
        exit();
    } else {
        set_flash("Sai tài khoản hoặc mật khẩu");
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h2>Login</h2>

<form method="post">
    Username:
    <input name="username" value="<?= htmlspecialchars($username_cookie) ?>"><br>
    Password:
    <input type="password" name="password"><br>
    <label>
        <input type="checkbox" name="remember"> Remember me
    </label><br><br>
    <button>Login</button>
</form>

<?php if ($msg = get_flash()): ?>
<p><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>
</body>
</html>

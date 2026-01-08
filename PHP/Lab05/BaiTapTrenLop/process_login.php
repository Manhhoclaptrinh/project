  <?php
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$correct_email = "admin@gmail.com";
$correct_password = "123456";

if ($email === $correct_email && $password === $correct_password) {
    $_SESSION['user'] = $email;
    header("Location: dashboard.php");
    exit();
} else {
    $_SESSION['error'] = "Sai email hoặc mật khẩu!";
    header("Location: login.php");
    exit();
}

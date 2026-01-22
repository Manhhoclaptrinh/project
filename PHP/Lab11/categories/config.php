  <?php
session_start();

try {
    $pdo = new PDO(
        "mysql:host=localhost;port=3307;dbname=lab_categories;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Kết nối thất bại");
}

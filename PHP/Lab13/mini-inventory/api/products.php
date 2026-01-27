<?php
require_once '../config/database.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

/* ===== SEARCH ===== */
if ($action === 'search') {
    $q = $_GET['q'] ?? '';

    if ($q === '') {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE is_deleted = 0");
        $stmt->execute();
    } else {
        $stmt = $pdo->prepare("
            SELECT * FROM products
            WHERE is_deleted = 0
            AND (name LIKE :q OR code LIKE :q)
        ");
        $stmt->execute(['q' => "%$q%"]);
    }

    echo json_encode($stmt->fetchAll());
    exit;
}

/* ===== DELETE ===== */
if ($action === 'delete') {
    $id = $_POST['id'] ?? 0;

    $stmt = $pdo->prepare("UPDATE products SET is_deleted = 1 WHERE id = ?");
    $ok = $stmt->execute([$id]);

    echo json_encode([
        'success' => $ok
    ]);
    exit;
}

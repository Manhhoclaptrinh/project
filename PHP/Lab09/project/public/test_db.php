<?php
require_once __DIR__ . '/../app/core/Database.php';
$db = Database::getInstance();
echo $db->query("SELECT COUNT(*) FROM students")->fetchColumn();

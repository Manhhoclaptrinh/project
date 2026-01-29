<?php
class Database {
    public static function connect() {
        try {
            $conn = new PDO(
                "mysql:host=localhost;port=3307;dbname=pagination_db;charset=utf8",
                "root",
                ""
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Lỗi kết nối: " . $e->getMessage());
        }
    }
}

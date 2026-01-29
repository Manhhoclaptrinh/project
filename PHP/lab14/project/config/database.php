<?php
class Database {
    public static function connect() {
        return new PDO(
            "mysql:host=localhost;port=3307;dbname=lab_upload;charset=utf8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}

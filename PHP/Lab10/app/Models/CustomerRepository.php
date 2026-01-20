<?php
require_once 'Database.php';

class CustomerRepository {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM customers")->fetchAll();
    }

    public function create($data) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $stmt = $this->db->prepare(
            "INSERT INTO customers(full_name,email,phone) VALUES (?,?,?)"
        );
        return $stmt->execute([
            $data['full_name'],
            $data['email'],
            $data['phone']
        ]);
    }
}

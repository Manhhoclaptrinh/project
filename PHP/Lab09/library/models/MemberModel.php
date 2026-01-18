<?php
require_once __DIR__ . '/../config/database.php';

class MemberModel {
    private $db;
    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM members ORDER BY id DESC")->fetchAll();
    }

    public function create($data) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email không hợp lệ");
        }
        $stmt = $this->db->prepare(
            "INSERT INTO members(member_code,full_name,email,phone)
             VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            $data['member_code'],
            $data['full_name'],
            $data['email'],
            $data['phone']
        ]);
    }

    public function delete($id) {
        return $this->db
            ->prepare("DELETE FROM members WHERE id=?")
            ->execute([$id]);
    }
}

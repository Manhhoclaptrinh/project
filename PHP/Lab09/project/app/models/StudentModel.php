<?php
require_once __DIR__ . '/../core/Database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all() {
        return $this->db->query("SELECT * FROM students ORDER BY id DESC")->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO students(code, full_name, email, dob) VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            $data['code'],
            $data['full_name'],
            $data['email'],
            $data['dob']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE students SET code=?, full_name=?, email=?, dob=? WHERE id=?"
        );
        return $stmt->execute([
            $data['code'],
            $data['full_name'],
            $data['email'],
            $data['dob'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id=?");
        return $stmt->execute([$id]);
    }
}

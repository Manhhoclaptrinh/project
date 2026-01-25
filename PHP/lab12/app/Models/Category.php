<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($q = '') {
        $sql = "SELECT * FROM categories WHERE name LIKE :q ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['q' => "%$q%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($name) {
        $stmt = $this->db->prepare("INSERT INTO categories(name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function update($id, $name) {
        $stmt = $this->db->prepare("UPDATE categories SET name=? WHERE id=?");
        return $stmt->execute([$name, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id=?");
        return $stmt->execute([$id]);
    }
}

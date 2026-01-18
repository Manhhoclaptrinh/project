<?php
require_once __DIR__ . '/../config/database.php';

class BookModel {
    private $db;
    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM books ORDER BY id DESC")->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO books(isbn,title,author,category,quantity)
                VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['isbn'],
            $data['title'],
            $data['author'],
            $data['category'],
            $data['quantity']
        ]);
    }

    public function update($id,$data) {
        $sql = "UPDATE books SET title=?,author=?,category=?,quantity=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['author'],
            $data['category'],
            $data['quantity'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id=?");
        return $stmt->execute([$id]);
    }
}

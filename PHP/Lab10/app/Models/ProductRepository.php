<?php
require_once 'Database.php';

class ProductRepository {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all($keyword = '', $sort = 'id') {
        $whitelist = ['id','name','price','stock'];
        if (!in_array($sort, $whitelist)) $sort = 'id';

        $sql = "SELECT * FROM products 
                WHERE name LIKE :kw OR sku LIKE :kw
                ORDER BY $sort";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['kw' => "%$keyword%"]);
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([(int)$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO products(name,sku,price,stock) VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            $data['name'],
            $data['sku'],
            $data['price'],
            $data['stock']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE products SET name=?, sku=?, price=?, stock=? WHERE id=?"
        );
        return $stmt->execute([
            $data['name'],
            $data['sku'],
            $data['price'],
            $data['stock'],
            (int)$id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([(int)$id]);
    }
}

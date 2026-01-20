<?php
require_once 'Database.php';

class OrderRepository {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function createOrder($customerId, $items) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare(
                "INSERT INTO orders(customer_id,order_date,total) VALUES (?,CURDATE(),0)"
            );
            $stmt->execute([$customerId]);
            $orderId = $this->db->lastInsertId();

            $total = 0;

            foreach ($items as $item) {
                $p = $this->db->prepare("SELECT price, stock FROM products WHERE id=?");
                $p->execute([$item['product_id']]);
                $product = $p->fetch();

                if ($product['stock'] < $item['qty']) {
                    throw new Exception("Không đủ tồn kho");
                }

                $subtotal = $product['price'] * $item['qty'];
                $total += $subtotal;

                $this->db->prepare(
                    "INSERT INTO order_items(order_id,product_id,qty,price)
                     VALUES (?,?,?,?)"
                )->execute([
                    $orderId,
                    $item['product_id'],
                    $item['qty'],
                    $product['price']
                ]);

                $this->db->prepare(
                    "UPDATE products SET stock = stock - ? WHERE id=?"
                )->execute([$item['qty'], $item['product_id']]);
            }

            $this->db->prepare(
                "UPDATE orders SET total=? WHERE id=?"
            )->execute([$total, $orderId]);

            $this->db->commit();
            return $orderId;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}

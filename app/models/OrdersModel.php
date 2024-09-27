<?php
class OrdersModel
{
    private $__conn;
    public function  __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function createOrder($userId, $cartItems, $totalAmount)
    {
        // Start a transaction
        $this->__conn->beginTransaction();
        try {
            // Insert into orders table
            $stmt = $this->__conn->prepare("INSERT INTO orders (user_id, total) VALUES (:user_id, :total)");
            $stmt->execute([':user_id' => $userId, ':total' => $totalAmount]);
            $orderId = $this->__conn->lastInsertId(); // Get the last inserted order ID

            // Insert order items
            foreach ($cartItems as $item) {
                $stmt = $this->__conn->prepare("INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (:order_id, :book_id, :quantity, :price)");
                $stmt->execute([
                    ':order_id' => $orderId,
                    ':book_id' => $item->id,
                    ':quantity' => $item->quantity,
                    ':price' => $item->price_out,
                ]);
            }

            // Commit transaction
            $this->__conn->commit();
            return $orderId;
        } catch (Exception $e) {
            // Rollback transaction on failure
            $this->__conn->rollBack();
            throw $e; // Re-throw the exception for further handling
        }
    }

    public function getUserOrders($userId)
    {
        $stmt = $this->__conn->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllOrders($limit = 10, $offset = 0)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT :limit OFFSET :offset";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
                $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateOrderStatus($id, $status)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "UPDATE orders SET status = :status WHERE id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("status", $status, PDO::PARAM_STR);
                $stmt->bindParam("id", $id, PDO::PARAM_INT);
                $stmt->execute();
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}

<?php 

    class OrderModel {

        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function createUserOrder($userID, $totalPrice) {
            $query = "INSERT INTO user_orders (orderID, userID, totalAmount, orderDate, statusCode)
                    VALUES (NULL, :userID, :totalPrice, NULL, :statusCode)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':totalPrice', $totalPrice);
            $statement->bindValue(':statusCode', 1);
            $result = $statement->execute();
            if ($result) {
                return $this->db->lastInsertId();
            } else {
                echo "Failure";
            }
        }   

        public function insertOrderProducts($orderID, $productID, $quantity, $itemPrice) {
            $query = "INSERT INTO order_products (orderID, productID, quantity, itemPrice)
            VALUES (:orderID, :productID, :quantity, :itemPrice)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->bindValue(':itemPrice', $itemPrice);
            $statement->bindValue(':quantity', $quantity);
            $statement->bindValue(':orderID', $orderID);
            $result = $statement->execute();



            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function oderPlaceFailure($orderID) {
            $query = "DELETE FROM user_orders WHERE orderID = :orderID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':orderID', $orderID);
            $statement->execute();
            $statement->closeCursor();
            $query2 = "DELETE FROM order_products WHERE orderID = :orderID";
            $statement2 = $this->db->prepare($query2);
            $statement2->bindValue(':orderID', $orderID);
            $statement2->execute();
            $statement2->closeCursor();
        }

        public function getOrders($id) {
            $query = "SELECT * FROM  user_orders WHERE userID = :userID ORDER BY orderID DESC";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $id);
            $statement->execute();
            $orders = $statement->fetchAll();
            $statement->closeCursor();
            return $orders;
        }

        public function getOrderProducts($orderID) {
            $query = "SELECT * FROM  order_products WHERE orderID = :orderID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':orderID', $orderID);
            $statement->execute();
            $orderProducts = $statement->fetchAll();
            $statement->closeCursor();
            return $orderProducts;
        } 

        public function getOrderStaus($orderID) {
            $query = "SELECT statusName FROM  status INNER JOIN user_orders 
                    ON user_orders.statusCode = status.statusCode 
                    WHERE user_orders.orderID = :orderID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':orderID', $orderID);
            $statement->execute();
            $status = $statement->fetch();
            $statement->closeCursor();
            if($status) {
                return $status['statusName'];
            }
        }

        public function changeOrderStatus($orderID, $statusCode) {
            $query = "UPDATE user_orders SET statusCode = :code WHERE orderID = :orderID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':orderID', $orderID);
            $statement->bindValue(':code', $statusCode);
            $result = $statement->execute();
            $statement->closeCursor();
            if($result) {
                echo "<script>location.reload;</script>";
            } else {
                echo "<script>alert('Order status could not be changed.');</script>";
            }
        }


        public function viewAllOrders() {
            $query = "SELECT * FROM user_orders ORDER BY orderID DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $orders = $statement->fetchAll();
            $statement->closeCursor();
            if(count($orders) > 0) {return $orders;}      
        }
        
        public function getStatuses(){
            $query = "SELECT * FROM status ORDER BY statusCode DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $statuses = $statement->fetchAll();
            $statement->closeCursor();
            if(count($statuses) > 0) {return $statuses;}  
        }
    }
?>
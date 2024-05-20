<?php 

    class CartModel {

        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function cart($ip) {
            if(isset($_GET['addToCart'])) {
                $productID = $_GET['addToCart'];
                if(!isset($_SESSION['user'])) {
                    $query  = "SELECT * FROM carts WHERE ipAddress = :ip 
                    AND productID = :productID";
                    $statement = $this->db->prepare($query);
                    $statement->bindValue(':ip', $ip);
                    $statement->bindValue(':productID', $productID);
                    $statement->execute();
                    $carts = $statement->fetchAll();
                    $statement->closeCursor();
                    $userID = 0;
                } else {
                    $userID = $_SESSION['user'];
                    $query  = "SELECT * FROM carts WHERE userID = :id 
                    AND productID = :productID";
                    $statement = $this->db->prepare($query);
                    $statement->bindValue(':id', $userID);
                    $statement->bindValue(':productID', $productID);
                    $statement->execute();
                    $carts = $statement->fetchAll();
                    $statement->closeCursor();
                }

                if(count($carts) > 0) {
                    echo "<script>alert('Item already exists in your cart.')</script>";
                } else {
                    $insertQuery = "INSERT INTO carts (productID, userID, ipAddress, quantity) VALUES (:productID, :userID, :ipAddress, :quantity)";
                    $statement = $this->db->prepare($insertQuery);
                    $statement->bindValue(':productID', $productID);
                    $statement->bindValue(':userID', $userID);
                    $statement->bindValue(':ipAddress', $ip);
                    $statement->bindValue(':quantity', 1);
                    $result = $statement->execute();
                    $statement->closeCursor();
                    
                    if($result) {
                        echo "<script>location.reload;</script>";
                    } else {
                        echo "<script>alert('Item could not be added to the cart.');</script>";
                    }
                }
            }
        }

        public function getTotalPrice($ip) {
            if(isset($_SESSION['user'])) {
                $id = $_SESSION['user'];
                $query = "SELECT * FROM carts WHERE userID = :userID";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':userID', $id);
                $statement->execute();
                $rows = $statement->fetchAll();
                $statement->closeCursor();
            }
            else {
                $query = "SELECT * FROM carts WHERE ipAddress = :ipAddress";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':ipAddress', $ip);
                $statement->execute();
                $rows = $statement->fetchAll();
                $statement->closeCursor();
            }

            $totalPrice = 0; 
            foreach($rows as $row) {
                $productID = $row['productID'];
                $quantity = $row['quantity'];
                $query = "SELECT price FROM products WHERE productID = :productID";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':productID', $productID);
                $statement->execute();
                $prices = $statement->fetchAll();
                $statement->closeCursor();
                foreach($prices as $price) {
                    $totalPrice += $quantity * $price['price']; 
                }
            }
            return $totalPrice;
        }

        public function getCartItems($ip) {
            if(isset($_SESSION['user'])) {
                $id = $_SESSION['user'];
                $query = "SELECT * FROM products INNER JOIN carts ON products.productID = carts.productID WHERE carts.userID = :userID";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':userID', $id);
                $statement->execute();
                $products = $statement->fetchAll();
                $statement->closeCursor();
            }
            else {
                $query = "SELECT * FROM products INNER JOIN carts ON products.productID = carts.productID WHERE carts.ipAddress = :ipAddress";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':ipAddress', $ip);
                $statement->execute();
                $products = $statement->fetchAll();
                $statement->closeCursor();
            }
            return $products;
        }

        public function getItemQuantity($productID, $ip) {
            if (isset($_SESSION['user'])) {
                $userID = $_SESSION['user'];
                $query = "SELECT quantity FROM carts WHERE productID = :productID AND userID = :id";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':productID', $productID);
                $statement->bindValue(':id', $userID);
                $statement->execute();
                $result = $statement->fetch();
                $statement->closeCursor();
                if($result) {
                    return $result['quantity'];
                }
            } else {
                $query = "SELECT quantity FROM carts WHERE productID = :productID AND ipAddress = :ipAddress";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':productID', $productID);
                $statement->bindValue(':ipAddress', $ip);
                $statement->execute();
                $result = $statement->fetch();
                $statement->closeCursor();
                if($result) {
                    return $result['quantity'];
                }
            }

        }


        public function deleteItem($ip) {
            if(isset($_GET['productID'])) {
                $id = $_GET['productID'];
                if(isset($_SESSION['user'])) {
                    $userID = $_SESSION['user'];
                    $query = "DELETE FROM carts WHERE productID = :productID AND userID = :userID";
                    $statement = $this->db->prepare($query);
                    $statement->bindValue(':productID', $id);
                    $statement->bindValue(':userID', $userID);
                    $result = $statement->execute();
                    $statement->closeCursor();
                }
                else {
                    $query = "DELETE FROM carts WHERE productID = :productID AND ipAddress = :ipAddress";
                    $statement = $this->db->prepare($query);
                    $statement->bindValue(':productID', $id);
                    $statement->bindValue(':ipAddress', $ip);
                    $result = $statement->execute();
                    $statement->closeCursor();
                }
                if($result) {
                    echo "<script>location.reload;</script>";
                } else {
                    echo "<script>alert('Item could not be removed.');</script>";
                }        
            }    
        }

        public function emptyCart() {
            $userID = $_SESSION['user'];
            $query = "DELETE FROM carts WHERE userID = :userID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function updateQuantity($ip) {
                if(isset($_GET['productID']) && $_GET['newQuantity'] > 0) {
                    $id = $_GET['productID'];
                    $quantity = $_GET['newQuantity'];
                    if(isset($_SESSION['user'])) {
                        $userID = $_SESSION['user'];
                        $query = "UPDATE carts SET quantity = :quantity WHERE productID = :productID AND userID = :userID";
                        $statement = $this->db->prepare($query);
                        $statement->bindValue(':productID', $id);
                        $statement->bindValue(':userID', $userID);
                        $statement->bindValue(':quantity', $quantity);
                        $result = $statement->execute();
                        $statement->closeCursor();
                    }
                    else {
                        $query = "UPDATE carts SET quantity = :quantity WHERE productID = :productID AND ipAddress = :ipAddress";
                        $statement = $this->db->prepare($query);
                        $statement->bindValue(':productID', $id);
                        $statement->bindValue(':ipAddress', $ip);
                        $statement->bindValue(':quantity', $quantity);
                        $result = $statement->execute();
                        $statement->closeCursor();
                    }
                    if($result) {
                        echo"<script>location.reload;</script>";
                    } else {
                        echo "<script>alert('Item quantity could not be updated.');</script>";
                    }  
                }  

          
        }

        public function updateCartUser($userID, $ip) {
            $search = "SELECT * FROM carts WHERE userID = :userID";
            $statement = $this->db->prepare($search);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor();
            if(count($rows) == 0) {
                $query = "UPDATE carts SET userID = :userID WHERE ipAddress = :ipAddress";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->bindValue(':ipAddress', $ip);
                $statement->execute();
                $statement->closeCursor();
            }

        }



    }
?>
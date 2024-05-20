<?php 

    class ProductModel{

        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function insertProduct($name, $description, $categoryID, $quantity, $price, $productImage) {
            $status = true;
            $query = "INSERT INTO products 
                      (productID, name, description, categoryID, quantity, price, productImage, addedOn) 
                      VALUES (NULL, :productName, :description, :categoryID, :quantity, :price, :productImage, null)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':productName', $name);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':quantity', $quantity);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':productImage', $productImage);
            $result = $statement->execute();
            $statement->closeCursor();

            if($result) {
                return true;
            } else {
                return false;
            }

        }

        public function getProducts() {
            if (isset($_GET['productID'])) {
                $id = $_GET['productID'];
                $query = "SELECT * FROM products WHERE productID = :id";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $products = $statement->fetchAll();
                $statement->closeCursor();
                return $products;
            } else {
                if(!isset($_GET['category'])) {
                    $query = "SELECT * FROM products ORDER BY rand() LIMIT 0,6";
                    $statement = $this->db->prepare($query);
                    $statement->execute();
                    $products = $statement->fetchAll();
                    $statement->closeCursor();
                    return $products;
                } else {
                    $categoryID = $_GET['category'];
                    $query = "SELECT * FROM products WHERE categoryID = :categoryID";
                    $statement = $this->db->prepare($query);
                    $statement->bindValue(':categoryID', $categoryID);
                    $statement->execute();
                    $products = $statement->fetchAll();
                    $statement->closeCursor();
                    return $products;
                }
            }

        }

        
        public function getAllProducts() {
            $query = "SELECT * FROM products ORDER BY rand()";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;

        }

        public function searchProduct ($data) {
            $query = "SELECT * FROM products WHERE name = :data";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':data', $data);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;
 
        }

        public function getProductByID($id) {
            $query = "SELECT * FROM products WHERE productID = :id";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $product = $statement->fetch();
            $statement->closeCursor();
            return $product;
        }

        public function deleteProduct($id) {
            $query2 = "DELETE FROM products WHERE productID = :productID";
            $statement2 = $this->db->prepare($query2);
            $statement2->bindValue(':productID', $id);
            $result = $statement2->execute();
            if($result) {
                header("Location: viewProducts.php");
            } else {
                echo "<script>alert('Couldn't delete the product.')</script>";
            }
        }

        public function updateProduct($id, $name, $description, $categoryID, $quantity, $price, $productImage) {

            $query = "UPDATE products SET name = :productName, description = :description, categoryID = :categoryID, quantity = :quantity, price = :price, productImage = :productImage WHERE productID = :productID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':productName', $name);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':quantity', $quantity);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':productImage', $productImage);
            $statement->bindValue(':productID', $id);
            $result = $statement->execute();
            $statement->closeCursor();

            if($result) {
                return true;
            } else {
                return false;
            }
        }

        public function updateQuantity($id, $quantity) {
            $query = "UPDATE products SET quantity = :quantity WHERE productID = :productID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':quantity', $quantity);
            $statement->bindValue(':productID', $id);
            $statement->execute();
            $statement->closeCursor();
        }
    }


?>
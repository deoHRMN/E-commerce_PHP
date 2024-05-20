<?php
    class CategoryModel {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }
 
        public function insertCategory($name, $description) {
            $query = "INSERT INTO categories (categoryID, name, description) 
            VALUES (NULL, :categoryname, :categorydescription)";

            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryname', $name);
            $statement->bindValue(':categorydescription', $description);
            $result = $statement->execute();
            $statement->closeCursor();

            if($result) {
                return true;
            } else {
                return false;
            }
        }

        public function getCategories () {
            $query = "SELECT * FROM categories ORDER BY name ASC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $categories = $statement->fetchAll();
            $statement->closeCursor();
            return $categories;
        }

        public function getCategoryByID($id) {
            $query = "SELECT * FROM categories WHERE categoryID = :categoryID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryID', $id);
            $statement->execute();
            $category = $statement->fetch();
            $statement->closeCursor();
            if($category) {
                return $category;
            }   
            
        }

        public function getCategoryByName($name) {
            $query = "SELECT * FROM categories WHERE name = :categoryName";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryName', $name);
            $statement->execute();
            $categories = $statement->fetchAll();
            $statement->closeCursor();
            return $categories;
        }

        public function updateCategory($id, $name, $description) {
            $query = "UPDATE categories SET name = :categoryName, description = :categoryDescription WHERE categoryID = :categoryID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':categoryName', $name);
            $statement->bindValue(':categoryDescription', $description);
            $statement->bindValue(':categoryID', $id);
            $result = $statement->execute();
            $statement->closeCursor();

            if ($result) {
                return true;
            } else {return false;}
        }

        public function deleteCategory($id){
            $query2 = "DELETE FROM categories WHERE categoryID = :categoryID";
            $statement2 = $this->db->prepare($query2);
            $statement2->bindValue(':categoryID', $id);
            $result = $statement2->execute();
            if($result) {
                header("Location: viewCategories.php");
            } else {
                echo "<script>alert('Couldn't delete the category.')</script>";
            }
        }

    }
?>
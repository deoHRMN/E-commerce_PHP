<?php 

    class ProductController {

        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function insertProduct($name, $description, $categoryID, $quantity, $price, $productImage){
            return $this->model->insertProduct($name, $description, $categoryID, $quantity, $price, $productImage);
        }

        public function getProducts() {
            return $this->model->getProducts();
        }

        public function searchProduct($data) {
            return $this->model->searchProduct($data);
        }
        
        public function getAllProducts() {
            return $this->model->getAllProducts();
        }

        public function getProductByID($id) {
            return $this->model->getProductByID($id);
        }

        public function deleteProduct($id) {
            return $this->model->deleteProduct($id);
        }

        public function updateProduct($id, $name, $description, $categoryID, $quantity, $price, $productImage) {
            return $this->model->updateProduct($id, $name, $description, $categoryID, $quantity, $price, $productImage);
        }

        public function updateQuantity($id, $quantity) {
            return $this->model->updateQuantity($id, $quantity);
        }
    }
?>
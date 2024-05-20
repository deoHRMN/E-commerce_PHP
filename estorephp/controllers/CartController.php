<?php 

    class CartController {
        
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function cart($ip) {
            return $this->model->cart($ip);
        }

        public function getTotalPrice($ip) {
            return $this->model->getTotalPrice($ip);
        }

        public function getCartItems($ip) {
            return $this->model->getCartItems($ip);
        }

        public function getItemQuantity($productID, $ip) {
            return $this->model->getItemQuantity($productID, $ip);
        }

        public function updateQuantity($ip) {
            return $this->model->updateQuantity($ip);
        }

        public function deleteItem($ip) {
            return $this->model->deleteItem($ip);
        }

        public function updateCartUSer($userID, $ip) {
            return $this->model->updateCartUser($userID, $ip);
        }

        public function emptyCart() {
            return $this->model->emptyCart();
        }

    }
?>
<?php

class OrderController {

    private $model;

    public function __construct($mdoel) {
        $this->model = $mdoel;
    }

    public function getOrders($userID) {
        return $this->model->getOrders($userID);

    }

    public function getOrderProducts($orderID) {
        return $this->model->getOrderProducts($orderID);

    }

    public function getOrderStaus($orderID) {
        return $this->model->getOrderStaus($orderID);
    }

    public function changeOrderStatus($orderID, $code) {
        return $this->model->changeOrderStatus($orderID, $code);
    }

    public function createUserOrder($userID, $totalPrice) {
        return $this->model->createUserOrder($userID, $totalPrice);
    }

    public function insertOrderProducts($orderID, $productID, $quantity, $itemPrice) {
        return $this->model->insertOrderProducts($orderID, $productID, $quantity, $itemPrice);
    }

    public function orderPlaceFailure($orderID) {
        return $this->model->orderPlaceFailure($orderID);
    }

    public function viewAllOrders() {
        return $this->model->viewAllOrders();
    }

    public function getStatuses(){
        return $this->model->getStatuses();
    }
}
<?php 

    class UserController {
        
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function createUser($username, $email, $password, $street, $city, $state, $country, $zipcode) {
            return $this->model->createUser($username, $email, $password, $street, $city, $state, $country, $zipcode);
        }

        public function doesUserExist($name, $email) {
            return $this->model->doesUserExist($name, $email);
        }

        public function userLogin($email, $password) {
            return $this->model->userLogin($email, $password);
        }

        public function getUserID($email) {
            return $this->model->getUserID($email);
        }

        public function getUserName($id) {
            return $this->model->getUserName($id);
        }

        public function logout() {
            return $this->model->logout();
        }

        public function getUserData($id) {
            return $this->model->getUserData($id);
        }

        public function changePassword($id, $old, $new) {
            return $this->model->changePassword($id, $old, $new);
        }

        public function deleteAccount($id, $password) {
            return $this->model->deleteAccount($id, $password);
        }

        public function updateUserData($id, $name, $email, $street, $city, $state, $country, $zipcode) {
            return $this->model->updateUserData($id, $name, $email, $street, $city, $state, $country, $zipcode);
        }

        public function viewAllUsers() {
            return $this->model->viewAllUsers();
        }
    }
?>
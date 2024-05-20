<?php 

    class AdminController {
        
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function createAdmin($username, $email, $password, $firstName, $lastName) {
            return $this->model->createAdmin($username, $email, $password, $firstName, $lastName);
        }

        public function doesAdminExist($name, $email) {
            return $this->model->doesAdminExist($name, $email);
        }

        public function AdminLogin($email, $password) {
            return $this->model->AdminLogin($email, $password);
        }

        public function getAdminID($email) {
            return $this->model->getAdminID($email);
        }

        public function getAdminName($id) {
            return $this->model->getAdminName($id);
        }

        public function logout() {
            return $this->model->logout();
        }

        public function getAdminData($id) {
            return $this->model->getAdminData($id);
        }

        public function changePassword($id, $old, $new) {
            return $this->model->changePassword($id, $old, $new);
        }

        public function deleteAccount($id, $password) {
            return $this->model->deleteAccount($id, $password);
        }

        public function updateAdminData($id, $name, $email, $firstName, $lastName) {
            return $this->model->updateAdminData($id, $name, $email, $firstName, $lastName);
        }
    }
?>
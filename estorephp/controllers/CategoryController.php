<?php

    class CategoryController {
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function insertCategory($name, $description) {
            return $this->model->insertCategory($name, $description);
        }

        public function getCategories() {
            return $this->model->getCategories();
        }

        public function getCategoryByID($id) {
            return $this->model->getCategoryByID($id);
        }

        public function getCategoryByName($name) {
            return $this->model->getCategoryByName($name);
        }

        public function updateCategory($id, $name, $description) {
            return $this->model->updateCategory($id, $name, $description);
        }
        
        
        public function deleteCategory($id) {
            return $this->model->deleteCategory($id);
        }
    }
?>

<?php
    include("../includes/connect.php");
    include("../controllers/CategoryController.php");
    include("../models/CategoryModel.php");

    $categoryModel = new CategoryModel($db);
    $categoryController = new CategoryController($categoryModel);

    if(isset($_POST['action']) && $_POST['action'] == "insert") {
        $categoryName = $_POST['categoryName'];
        $categoryDescription = $_POST['categoryDescription'];
        $rows = count($categoryController->getCategoryByName($categoryName));
        if($rows > 0) {
            echo "<script>alert('This category name already exists.')</script>";
        } else {
            if($categoryController->insertCategory($categoryName, $categoryDescription)){
                echo "<script>alert('Category has been added successfully.')</script>";
            } else {
                echo "<script>alert('Category coudl not be added.')</script>";
            }
        }
    }
?>

<h2 class="text-center">Add a Category</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="categoryName" placeholder="Name of Category" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-90 mb-2">
    <span class="input-group-text"><i class="fa-solid fa-receipt"></i></span>
    <textarea class="form-control" name="categoryDescription" placeholder="Description"></textarea>
    </div>
    <input type="hidden" name="action" value="insert">
    <div class="input-group w-10 mb-2" m-auto>
        <input type="submit" class="bg-success border-0 p-2 my-3 text-white" name="insertCategory" value="Add Category">
    </div>
</form>
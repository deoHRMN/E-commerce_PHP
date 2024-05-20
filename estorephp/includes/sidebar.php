<div class="col-lg-2 pt-5 bg-secondary">
<?php 
    include("connect.php");
    include("./controllers/CategoryController.php");
    include("./models/CategoryModel.php");
    $categoryModel = new CategoryModel($db);
    $categoryController = new CategoryController($categoryModel);
    $categories = $categoryController->getCategories();
?>
    <ul class="navbar-nav text-white text-center">
        <li class="nav-item">
            <a class="nav-link"><h4>Categories</h4></a>
        </li>
        <?php 

            foreach($categories as $category){
                echo'<li class="nav-item">
                <a href="index.php?category='.$category['categoryID'].'" class="nav-link">'.$category['name'].'</a>
                </li>';
            }
        ?>

    </ul>     
</div>
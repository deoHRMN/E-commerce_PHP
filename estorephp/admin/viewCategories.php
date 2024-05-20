<?php 
    include("../includes/connect.php");
    include("../models/CategoryModel.php");
    include("../controllers/CategoryController.php");

    $categoryModel = new CategoryModel($db);
    $categoryController = new CategoryController($categoryModel);

    $categories = $categoryController->getCategories();

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "deleteCategory":
                $categoryController->deleteCategory($_GET['categoryID']);
                break;
    }}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("nav.php") ?>
        <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="row text-center">
            <h3>All categoriess</h3>
            <table class="table table-hover mt-2">
                <thead>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php 
                    foreach($categories as $category) {
                        echo'
                            <tr>
                                <td>'.$category['name'].'</td>
                                <td>'.$category['description'].'</td>
                                <td class="p-2 d-flex"><form action="updateCategory.php" method="GET">
                                <input type="hidden" name="categoryID" value="'.$category['categoryID'].'">
                                <input type="hidden" name="action" value="updateCategory">
                                <input type="submit" class="btn btn-success m-2" value="Edit">
                                </form>
                                <form action="" method="GET">
                                <input type="hidden" name="categoryID" value="'.$category['categoryID'].'">
                                <input type="hidden" name="action" value="deleteCategory">
                                <input type="submit" class="btn btn-danger m-2" value="Delete">
                                </form>
                            </tr>
                        ';
                    } 

                ?>
                </tbody>
        </table>    
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>
  
    <?php include("../includes/footer.php") ?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
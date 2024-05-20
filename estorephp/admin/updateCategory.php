<?php 
    include("../includes/connect.php");
    include("../models/CategoryModel.php");
    include("../controllers/CategoryController.php");

    $categoryModel = new CategoryModel($db);
    $categoryController = new CategoryController($categoryModel);

    $category = $categoryController->getCategoryByID($_GET['categoryID']);

    if(isset($_POST['action'])){
        switch($_POST['action']){
            case "update":
                if($categoryController->updateCategory($_POST['categoryID'], $_POST['name'], $_POST['description'])){
                    header("Location: viewCategories.php");
                }
                break;
    }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
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
        <h2 class="text-center">Edit Category</h2>
        <form action="" method="post" class="mb-2">
            <div class="input-group w-90 mb-2">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
                <input type="text" class="form-control" name="name" value="<?php echo $category['name']?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group w-90 mb-2">
            <span class="input-group-text"><i class="fa-solid fa-receipt"></i></span>
            <textarea class="form-control" name="description"> <?php echo $category['description']?></textarea>
            </div>
            <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']?>">
            <input type="hidden" name="action" value="update">
            <div class="input-group w-10 mb-2" m-auto>
                <input type="submit" class="bg-success border-0 p-2 my-3 text-white" name="Update" value="Update Category">
            </div>
        </form>
        </div>
        <div class="col-lg-3"></div>

        
    </div>
    <?php include("../includes/footer.php") ?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
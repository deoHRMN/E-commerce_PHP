<?php 
    include("../includes/connect.php");
    include("../controllers/CategoryController.php");
    include("../models/CategoryModel.php");
    include("../models/ProductModel.php");
    include("../controllers/ProductController.php");

    $categoryModel = new CategoryModel($db);
    $categoryController = new CategoryController($categoryModel);
    $categories = $categoryController->getCategories();

    $productModel = new ProductModel($db);
    $productController = new ProductController($productModel);

    if(isset($_POST['action']) && $_POST['action'] == "insertProduct") {
        $name = $_POST['productName'];
        $description = $_POST['description'];
        $category = $_POST['productCategory'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $productImage = $_FILES['productImage']['name'];
        $tempImage = $_FILES['productImage']['tmp_name'];

        move_uploaded_file($tempImage, "./productImages/$productImage");

        if($productController->insertProduct($name, $description, $category, $quantity, $price, $productImage)) {
            echo "<script>alert('Product has been added successfully.')</script>";
        } else {
            echo "<script>alert('Product could not be added.')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <?php include("nav.php") ?>
    <div class="container w-50 mt-5">
        <h1 class="text-center mb-5">Add Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <input type="text" name="productName" id="productName" class="form-control" placeholder="Name of the Product" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="description" id="description" class="form-control" placeholder="Description of the Product" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <select name="productCategory" class="form-select" required>
                    <option value="">Select the category</option>
                    <?php 
                        foreach($categories as $category) {
                            echo '<option value="'.$category['categoryID'].'">'.$category['name'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="price" id="price" class="form-control" placeholder="Price" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="file" name="productImage" id="productImage" class="form-control" required>
            </div>
            <div class="form-outline mb-4">
                <input type="hidden" name="action" value="insertProduct">
                <input type="submit" name="insertProduct" class="form-control bg-success text-white">
            </div>
        </form>
    </div>
    <?php include("../includes/footer.php") ?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
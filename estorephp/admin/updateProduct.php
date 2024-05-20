<?php 
    include("../includes/connect.php");
    include("../controllers/ProductController.php");
    include("../models/ProductModel.php");
    include("../models/CategoryModel.php");
    include("../controllers/CategoryController.php");

    $categoryModel = new CategoryModel($db);
    $categoryController = new CategoryController($categoryModel);
    $productModel = new ProductModel($db);
    $productController = new ProductController($productModel);

    
    $product = $productController->getProductByID($_GET['productID']);
    $category = $categoryController->getCategoryByID($product['categoryID']);
    $categories = $categoryController->getCategories();
    if(isset($_POST['action'])){
        switch($_POST['action']){
            case "update":
                $id = $_POST['productID'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $categoryID = $_POST['categoryID'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $productImage = $_FILES['productImage']['name'];
                echo $productImage;
                if($productImage != "") {
                    $tempImage = $_FILES['productImage']['tmp_name'];
                    move_uploaded_file($tempImage, "./productImages/$productImage");

                } else { 
                    $productImage = $product['productImage'];
                }
                
                
                if($productController->updateProduct($id, $name, $description, $categoryID, $quantity, $price, $productImage)){
                    header("Location: viewProducts.php");
                }   else {
                    echo "<script>alert('Product Update failed.')</script>";
                }
                break;
              
                }
                
            }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("nav.php") ?>
    <div class="container w-50 mt-5">
        <h1 class="text-center mb-5">Edit Product Details</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $product['name']?>" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="description" id="description" class="form-control" value="<?php echo $product['description']?>" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <select name="categoryID" class="form-select" required>
                    <option value="<?php echo $product['categoryID']?>"><?php echo $category['name']?></option>
                    <?php 
                        foreach($categories as $category) {
                            echo '<option value="'.$category['categoryID'].'">'.$category['name'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="quantity" id="quantity" class="form-control" value="<?php echo $product['quantity']?>" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="price" id="price" class="form-control" value="<?php echo $product['price']?>" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="file" name="productImage" id="productImage" class="form-control">
                <p><?php $product['productImage']?></p>
            </div>
            <div class="form-outline mb-4">
                <input type="hidden" name="productID" value="<?php echo $product['productID']?>">
                <input type="hidden" name="action" value="update">
                <input type="submit" name="insertProduct" class="form-control bg-success text-white">
            </div>
        </form>
    </div>
        
    <?php include("../includes/footer.php") ?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
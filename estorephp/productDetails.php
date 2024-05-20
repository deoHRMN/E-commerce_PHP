<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php - Product Details</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("./includes/nav.php") ?>
    <div class="bg-dark text-white p-3">
        <h3 class="text-center">Online Store</h3>
        <p class="text-center">Here are the product details.</p>
    </div>
    <div class="row">
        <?php include("./includes/sidebar.php") ?>
        <div class="col lg-10 p-5">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <?php 
                        include("./includes/connect.php");
                        include("./controllers/ProductController.php");
                        include("./models/ProductModel.php");

                        $productModel = new ProductModel($db);
                        $productController = new ProductController($productModel);
                        

                        if (isset($_GET['productID'])) {
                            $product = $productController->getProductByID($_GET['productID']);
                            $category = $categoryController->getCategoryByID($product['categoryID']);
                            echo'
                            <div class="row" text-center>
                            <img src="./admin/productImages/'.$product["productImage"].'" class="card-img-top" alt="'.$product["name"].'">
                            </div>
                            <div class="row text-center">
                            <h3>Product Details</h3>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>'.$product['name'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>'.$product['description'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>'.$category['name'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td>'.$product['quantity'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>CAD '.$product['price'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Added On</td>
                                        <td>'.$product['addedOn'].'</td>
                                    </tr>
                                </tbody>
                            </table>    
                            </div>';
                        }        
                    ?>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
    <?php include("./includes/footer.php")?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
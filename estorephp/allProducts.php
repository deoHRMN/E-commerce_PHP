<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php - All Products</title>
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
        <p class="text-center">These are all the products offered at our store.</p>
    </div>
    <div class="row p-3">
        <div class="col lg-10 p-5">
            <!-- products -->
            <div class="row">
            <?php 
                include("./includes/connect.php");
                include("./controllers/ProductController.php");
                include("./models/ProductModel.php");


                $productModel = new ProductModel($db);
                $productController = new ProductController($productModel);
                $cartModel = new CartModel($db);
                $cartController = new CartController($cartModel);
            
                $cartController->cart(getIPAddress());
                $products = $productController->getAllProducts();
                
                if(count($products) > 0) {
                    foreach($products as $product) {
                        if(strlen($product['description']) < 55) {
                            $description = $product['description'];
                        } else {
                            $description = substr($product['description'], 0, 55) . "...";

                        }
                        echo "
                        <div class='col-md-4 mb-4'>
                        <div class='card'>
                        <img src='./admin/productImages/{$product['productImage']}' class='card-img-top' alt='{$product['name']}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$product['name']}</h5>
                                <p class='card-text'>{$description}</p>
                                <p class='card-text'>CAD {$product['price']}</p>";
                                if ($product['quantity'] > 0) {
                                    echo "<a href='index.php?addToCart={$product['productID']}' class='btn btn-primary'>Add to Cart</a>";
                                } else {
                                    echo "<a class='btn btn-danger'>Out of stock</a>";
                                }
                                
                                 echo "<a href='productDetails.php?productID={$product['productID']}' class='btn btn-secondary'>View Details</a>
                            </div>
                        </div>
                        </div>
                        ";
                    }
                } else {
                    echo "<h2 class='text-center'>Sorry, No Products found.</h2>";
                }


            ?>

            </div>
        </div>
    </div>
    <?php include("./includes/footer.php")?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
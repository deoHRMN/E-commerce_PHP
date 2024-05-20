

<!-- products -->
<div class="row">
<?php 
    include("connect.php");
    include("./controllers/ProductController.php");
    include("./models/ProductModel.php");

    $productModel = new ProductModel($db);
    $productController = new ProductController($productModel);
    $cartModel = new CartModel($db);
    $cartController = new CartController($cartModel);

    $cartController->cart(getIPAddress());

    if(isset($_GET['action']) && $_GET['action'] == "searchProduct") {
        $products = $productController->searchProduct($_GET['data']);
    } else {
        $products = $productController->getProducts();
    }
    
    

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


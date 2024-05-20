
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php - Shopping Cart</title>
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
        <h3 class="text-center">Shopping Cart</h3>
        <p class="text-center">Here are the items that you added to your cart.</p>
    </div>
    <div class="container mt-5 mb-5 text-center">
            <?php

                include("./models/OrderModel.php");
                include("./controllers/OrderController.php");
                include("./controllers/ProductController.php");
                include("./models/ProductModel.php");
            
                $productModel = new ProductModel($db);
                $productController = new ProductController($productModel);

                $orderModel = new OrderModel($db);
                $orderController = new OrderController($orderModel);

                if(isset($_GET['action'])) {
                    switch($_GET['action']) {
                        case "updateQuantity" :
                            $cartController->updateQuantity(getIPAddress());
                            break;
                        case "deleteItem" :
                            $cartController->deleteItem(getIPAddress());
                            break;
                    }
                    
                }
                $products = $cartController->getCartItems(getIPAddress());
                if(count($products) > 0) { ?>
                        <div class="row">
        <table class="table-bordered  text-center">
            <thead>
                <th>Name</th>
                <th>Image</th>
                <th>Current Quantity</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Remove</th>
                <th>Update</th>
            </thead>
            <tbody>
                <?php 
                    foreach($products as $product) {
                        $quantity = $cartController->getItemQuantity($product['productID'], getIPAddress());
                        $itemPrice = $quantity * $product['price'];
            ?>  

                <tr>
                    <td class="p-2"><?php echo $product['name']?></td>
                    <td class="p-2"><img style="width:100%; height:150px; object-fit: contain;" src="./admin/productImages/<?php echo $product['productImage']?>" alt="<?php echo $product['name'] ?>"></td>
                    <form action="" method="get">
                    <td class="p-2"><?php echo $quantity?></td>
                    <td class="p-2"><input class="form-input" type="text" name="newQuantity"></td>
                    <td class="p-2">CAD <?php echo $itemPrice ?></td>
                    <input type="hidden" name="productID" value="<?php echo $product['productID']?>">
                    <input type="hidden" name="action" value="updateQuantity">
                    <td class="p-2"><input type="submit" value="Update" class="btn btn-info m-2"></td>
                    </form>
                    <form action="" method="get" >
                        <input type="hidden" name="action" value="deleteItem">
                        <input type="hidden" name="productID" value="<?php echo $product['productID']?>">
                        <td class="p-2"><input type="submit" value="Remove"  class="btn btn-danger m-2"></td>
                    </form>
                </tr>
            <?php } ?>

            </tbody>
        </table>
        <div class="d-flex">
            <h4 class="mt-3">SubTotal: CAD <?php $totalAmount = $cartController->getTotalPrice(getIPAddress()); echo $totalAmount;?></h4>
            <?php 
                if(isset($_POST['action']) && $_POST['action'] == "placeOrder") {
                    if (isset($_SESSION['user'])) {
                        $insertedID = $orderController->createUserOrder($_SESSION['user'], $totalAmount); 
                        $allInserted = false;
                        foreach($products as $product) {
                            $quantity = $cartController->getItemQuantity($product['productID'], getIPAddress());
                            $itemPrice = $quantity * $product['price'];
                            if($orderController->insertOrderProducts($insertedID, $product['productID'], $quantity, $itemPrice)) {
                                $newQuantity = $productController->getProductByID($product['productID'])['quantity'] - $quantity;
                                $productController->updateQuantity($product['productID'], $newQuantity);
                                $allInserted = true;
                            } else {
                                $allInserted = false;
                            }
                        }
                        if($allInserted) {
                            $cartController->emptyCart();
                            echo "<script>alert('Order has been placed successfully.'); location.reload();</script>";       
                        } else {
                            $orderController->orderPlaceFailure($insertedID);
                            echo "<script>alert('Order could not be placed.');</script>";
                        }   
                    } else {
                        echo '<script>window.location.replace("./user/login.php")</script>';
                    }
                }
            ?>
            <form action="" method="post">
                <input type="hidden" name="action" value="placeOrder">
                <input type="submit" class='btn btn-success m-2' value="Place Order">
            </form>
            
        </div>
        <?php } else {echo '
            <img src="./images/emptyCart.png" style="width:100%; height:300px; object-fit: contain" alt="empty Cart">
            <br>
            <h4>Empty Cart</h4>';}?>
    </div>
    </div>

    <?php include("./includes/footer.php")?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
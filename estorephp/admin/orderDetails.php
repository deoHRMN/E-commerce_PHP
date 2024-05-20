<?php session_start(); 
    include("../includes/connect.php");
    include("../models/AdminModel.php");
    include("../controllers/AdminController.php");
    include("../controllers/OrderController.php");
    include("../models/OrderModel.php");
    include("../controllers/ProductController.php");
    include("../models/ProductModel.php");

    $adminModel = new AdminModel($db);
    $adminController = new AdminController($adminModel);
    if(isset($_SESSION['admin'])) {
        $adminID = $_SESSION['admin'];
        $adminName = $adminController->getAdminName($adminID)['firstName'];

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php 
    if(isset($_SESSION['admin'])) { 
        ?>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <div class="container-fluid">
                <img src="../images/shoplogo.png" class="logo" alt="">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="adminProfile.php" class="nav-link text-white"> Welcome <?php echo $adminName?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <div class="bg-light">
        <h3 class="text-center p-2">Welcome to the admin Dashobard. Here are your options.</h3>
    </div>
    <div class="row">
        <div class="col-lg-12 bg-secondary p-1">
            <div class="button text-center">
                <button><a href="index.php?insertCategory" class="nav-link text-dark p-2">Add Category</a></button>
                <button><a href="viewCategories.php" class="nav-link text-dark p-2">View Categories</a></button>
                <button><a href="insertProduct.php" class="nav-link text-dark p-2">Add Product</a></button>
                <button><a href="viewProducts.php" class="nav-link text-dark p-2">View Products</a></button>
                <button><a href="index.php?viewUsers" class="nav-link text-dark p-2">View Users</a></button>
                <button><a href="index.php?viewOrders" class="nav-link text-dark p-2">View Orders</a></button>
                <button><a href="logout.php" class="nav-link text-dark p-2">Logout</a></button>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <?php 
            if (isset($_GET['insertCategory'])) {
                include("./insertCategory.php");
            } else if (isset($_GET['viewUsers'])) {
                include("./viewUsers.php");
            } else if (isset($_GET['viewOrders'])) {
                include("./viewOrders.php");
            } 

            $orderModel = new OrderModel($db);
            $orderController = new OrderController($orderModel);
            $productModel = new ProductModel($db);
            $productController = new ProductController($productModel);
                        

            if (isset($_GET['orderID'])) {
                $orderedProducts = $orderController->getOrderProducts($_GET['orderID']);
                echo "Ordered Products For Order Number: {$_GET['orderID']}";
               
                foreach($orderedProducts as $ordered) {
                    if (isset($ordered['productID'])) {
                        $product = $productController->getProductByID($ordered['productID']);
                        echo'
                        <div class="row" text-center>
                        <img src="./productImages/'.$product["productImage"].'" class="card-img-top" alt="'.$product["name"].'">
                        </div>
                        <div class="row text-center">
                        <h3>Product Details</h3>
                        <table class="table table-hover mt-2">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>'.$product['name'].'</td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>'.$ordered['quantity'].'</td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>CAD '.$ordered['itemPrice'].'</td>
                                </tr>
                            </tbody>
                        </table>    
                        </div>';
                    } else {
                        echo "";
                    }

                }

            }        
        ?>

    </div>
    <?php  include("../includes/footer.php");
    }   else {
        header("Location: login.php");
    } 
    ?>

    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
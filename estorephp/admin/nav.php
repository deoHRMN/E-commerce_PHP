<?php session_start(); 
    include("../includes/connect.php");
    include("../models/AdminModel.php");
    include("../controllers/AdminController.php");
    $adminModel = new AdminModel($db);
    $adminController = new AdminController($adminModel);
    if(isset($_SESSION['admin'])) {
        $adminID = $_SESSION['admin'];
        $adminName = $adminController->getAdminName($adminID)['firstName']; 
} ?>

        <div class="container-fluid p-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
                    <div class="container-fluid">
                        <img src="../images/shoplogo.png" class="logo" style="height: 50px; width: 50px;" alt="">
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
                ?>
            </div>
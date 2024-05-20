<?php 
    session_start();
    include("./includes/connect.php");
    include("./includes/getIP.php");
    include("./models/UserModel.php");
    include("./controllers/UserController.php");
    include("./models/CartModel.php");
    include("./controllers/CartController.php");

    $cartModel = new CartModel($db);
    $cartController = new CartController($cartModel);
    
    $userModel = new UserModel($db);
    $userController = new UserController($userModel);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="index.php"><img src="./images/shoplogo.png" class="logo" alt="logo image"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="allProducts.php">Products</a>
            </li>
            <?php if(!isset($_SESSION['user'])) { ?>
            <li class="nav-item">
            <a class="nav-link" href="./user/register.php">Register</a>
            </li> <?php }?>
            <li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </li>
            <div class="d-flex">
            <?php if(isset($_SESSION['user'])){echo '
                <li class="nav-item ml-3">
                <a class="nav-link" href="./userProfile.php">'.$userController->getUserName($_SESSION['user']).'</a>
                </li>
                <li class="nav-item ml-3">
                <a class="btn bg-danger" href="./user/logout.php">Logout</a>
                </li>
                ';} 
                else 
                {echo '
                    <li class="nav-item ml-3">
                    <a class="nav-link">Guest</a>
                    </li>
                    <li class="nav-item ml-3">
                    <a class="btn btn-outline-success" href="./user/login.php">Login</a>
                    </li>
                ';} ?>
            </div>
        </ul>
        <form class="d-flex" method="get" action="index.php">
            <input class="form-control me-2" type="search" name="data" placeholder="Search" aria-label="Search">
            <input type="hidden" name="action" value="searchProduct">
            <input type="submit" value="Search" class="btn btn-outline-success">
        </form>
        </div>
    </div>
</nav>

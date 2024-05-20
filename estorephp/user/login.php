<?php 
    include("../includes/connect.php");
    include("../includes/getIP.php");
    include("../models/UserModel.php");
    include("../controllers/UserController.php");
    include("../models/CartModel.php");
    include("../controllers/CartController.php");

    $userModel = new UserModel($db);
    $userController = new UserController($userModel);
    $cartModel = new CartModel($db);
    $cartController = new CartController($cartModel);

    if(isset($_POST['action']) && $_POST['action'] == "userLogin") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $ip = getIPAddress();
        if($userController->userLogin($email, $password)) {
            $userID = $userController->getUserID($email);
            $_SESSION['user'] = $userID;
            $cartController->updateCartUser($userID, $ip);
            header("Location: ../index.php");
        } else{
            $message = "Invalid username or password.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php - Login Page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include("nav.php") ?>
<div class="bg-dark text-white p-3">
        <h3 class="text-center">Login Page</h3>
        <p class="text-center">Fill this form to login</p>
</div>
<form class="bg-secondary p-4" action="" method="POST">
    <div class="row">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">
            <div class="row">
            <div class="form-group p-2">
                <input type="text" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group p-2">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group p-2">
                <input type="hidden" name="action" value="userLogin">
                <p style="color: red;"><?php if(isset($message)) {echo $message;}?></p>
                <input type="submit" value="submit" class="btn btn-success"></input>
            </div>
            <div class="p-1">
                <p>Don't have an account? <a style="color:white;" href="register.php">Register Here.</a></p>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3"></div>
    </div>
</form>
<?php include("../includes/footer.php")?>
<!-- bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
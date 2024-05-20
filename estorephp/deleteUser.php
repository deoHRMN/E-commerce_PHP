<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php- - Change Password</title>
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
        <h3 class="text-center">Hello <?php echo $userController->getUserName($_SESSION['user'])?>!</h3>
        <p class="text-center">Here, you can mannage your account and orders.</p>
    </div>
    <div class="row">
        <?php include("./user/profileSidebar.php");  ?>
        <div class="col lg-10 p-5">
            <?php 
                if(isset($_POST['action']) && $_POST['action'] == "deleteUser") {
                    $id = $_SESSION['user'];
                    $password = $_POST['password'];


                    $result = $userController->deleteAccount($id, $password);
                    switch($result){
                        case 1:
                            echo "<script>alert('Account has been deleted.')</script>";
                            header("Location: ./user/logout.php");
                            break;
                        case 2:
                            $message = "Server Error. Please try again.";
                            break;
                        case 3:
                            $message = "Invalid Password.";
                    }
                }
                
            ?>
        <form class="bg-secondary p-4" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                    <h4>Deleting the account is a permanent action. Are you sure?</h4>
                    <div class="form-group p-2">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group p-2">
                        <input type="hidden" name="action" value="deleteUser">
                        <p style="color: red;"><?php if(isset($message)) {echo $message;}?></p>
                        <input type="submit" value="Delete Account" class="btn btn-danger"></input>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>
        </form>
        </div>
    </div>
    <?php include("./includes/footer.php")?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php- - Edit Profile</title>
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
        <p class="text-center">Here, you can edit your account details.</p>
    </div>
    <div class="row">
        <?php include("./user/profileSidebar.php");  ?>
        <div class="col lg-10 p-5">
            <?php 
                $id = $_SESSION['user'];
                $user = $userController->getUserData($id);
                if(isset($_POST['action']) && $_POST['action'] == "updateUser") {
                    $name = $_POST['username'];
                    $email = $_POST['email'];
                    $street = $_POST['street'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $country = $_POST['country'];
                    $zipcode = $_POST['zipcode'];
                    if($userController->updateUserData($id, $name, $email, $street, $city, $state, $country, $zipcode)) {
                        header("Location: userProfile.php");
                    } else {
                        $message = "Error while updating account.";
                    }

                    
                }
            ?>
        <form class="bg-secondary p-4" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                    <div class="form-group p-2">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $user['username']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $user['email']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">Street Address</label>
                        <input type="text" class="form-control" name="street" value="<?php echo $user['street']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="city" value="<?php echo $user['city']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">State/Province</label>
                        <input type="text" class="form-control" name="state" value="<?php echo $user['state']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" value="<?php echo $user['country']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">Postal Code</label>
                        <input type="text" class="form-control" name="zipcode" value="<?php echo $user['zipcode']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <input type="hidden" name="action" value="updateUser">
                        <p style="color: red;"><?php if(isset($message)) {echo $message;}?></p>
                        <input type="submit" value="Update" class="btn btn-success"></input>
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
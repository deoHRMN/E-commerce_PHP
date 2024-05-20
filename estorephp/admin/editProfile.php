<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edit Profile</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("nav.php") ?>
    <div class="row">
        <?php include("profileSidebar.php");  ?>
        <div class="col lg-10 p-5">
            <?php 
                $id = $_SESSION['admin'];
                $admin = $adminController->getAdminData($id);
                if(isset($_POST['action']) && $_POST['action'] == "updateAdmin") {
                    $name = $_POST['username'];
                    $email = $_POST['email'];
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    if($adminController->updateAdminData($id, $name, $email, $firstName, $lastName)) {
                        header("Location: adminProfile.php");
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
                        <label class="form-label">Admin Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $admin['username']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $admin['email']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" value="<?php echo $admin['firstName']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastName" value="<?php echo $admin['lastName']?>" required>
                    </div>
                    <div class="form-group p-2">
                        <input type="hidden" name="action" value="updateAdmin">
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
    <?php include("../includes/footer.php")?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
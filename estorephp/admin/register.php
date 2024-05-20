<?php 
    include("../includes/connect.php");
    include("../includes/getIP.php");
    include("../models/AdminModel.php");
    include("../controllers/AdminController.php");

    $adminModel = new AdminModel($db);
    $adminController = new AdminController($adminModel);

    if(isset($_POST['action']) && $_POST['action'] == "createAdmin") {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];

        $ip = getIPAddress();

        if($password !=$password_confirm) {
            $message = "Passwords don't match.";
        } else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            if($adminController->doesAdminExist($name, $email)){
                $message3 =  "Admin username or email already exists.";
            } else {
                if($adminController->createAdmin($name, $email, $hash, $firstName, $lastName)) {
                    header("Refresh: 5, url= login.php");
                    $message2 = "Registration successfull. Redirecting in 5 seconds...";
                } else {
                    echo "<script>alert('Error creating account. Try again later.');</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="bg-dark text-white p-3">
        <h3 class="text-center">Registration Page</h3>
        <p class="text-center">Please fill in all the fields to create your admin account.</p>
    </div>
    <div class="bg-light container w-50 mt-5 mb-5 p-3">
        <h1 class="text-center mb-5">Register yourself</h1>
        <form action="" method="POST">
            <div class="form-outline mb-4">
                <input type="text" name="username" class="form-control" placeholder="Create a Username" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control" placeholder="Create a Password" required>
            </div>
            <div class="form-outline mb-4">
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="firstName" class="form-control" placeholder="firstName Name" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="text" name="lastName" class="form-control" placeholder="lastName" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4">
                <input type="hidden" name="action" value="createAdmin">
                <input type="submit" value="Register" class="form-control bg-success text-white">
                <p style="color:red;"><?php if(isset($message)) {echo $message;} else if (isset($message3)) {echo $message3;} ?></p>
                <p style="color:green;"><?php if(isset($message2)) {echo $message2;} ?></p>
            </div>
        </form>
        <div class="p-1">
            <p>Have an account? <a style="color:blue;" href="login.php">Login Here.</a></p>
        </div>
    </div>
    <?php include("../includes/footer.php"); ?>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
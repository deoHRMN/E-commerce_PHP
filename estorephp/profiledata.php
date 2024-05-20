<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?php
            /*
            include("./models/UserModel.php");
            include("./controllers/UserController.php");

            $userModel = new UserModel($db);
            $userController = new UserController($userModel);
            */
            $userID = $_SESSION['user'];
            $user = $userController->getUserData($userID);
        ?>
            <div class="row text-center">
            <h3>Account Details</h3>
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $user['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $user['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Street Address</td>
                        <td><?php echo $user['street'] ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $user['city'] ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $user['state'] ?></td>
                    </tr>
                    <tr>
                        <td>country</td>
                        <td><?php echo $user['country'] ?></td>
                    </tr>
                    <tr>
                        <td>zipcode</td>
                        <td><?php echo $user['zipcode'] ?></td>
                    </tr>
                    <tr>
                </tbody>
            </table>    
            </div>
    </div>
<div class="col-lg-3"></div>
</div>
</div>
</div>
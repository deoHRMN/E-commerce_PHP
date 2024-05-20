<?php 
    include("../includes/connect.php");
    include("../models/UserModel.php");
    include("../controllers/UserController.php");

    $userModel = new UserModel($db);
    $userController = new UserController($userModel);

    $users = $userController->viewAllUsers();
?>

        <div class="row text-center">
            <h3>All users</h3>
            <table class="table table-hover mt-2">
                <thead>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Address</th>
                </thead>
                <tbody>
                <?php 
                    foreach($users as $user) {
                        echo'
                            <tr>
                                <td>'.$user['userID'].'</td>
                                <td>'.$user['username'].'</td>
                                <td>'.$user['email'].'</td>
                                <td>'.$user['street'].', '.$user['city'].', '.$user['state'].', '.$user['country'].', '.$user['zipcode'].'</td>
                            </tr>
                        ';

                    }        
                ?>
                </tbody>
        </table>    
        </div>
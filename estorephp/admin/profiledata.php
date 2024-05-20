<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?php
            $adminID = $_SESSION['admin'];
            $admin = $adminController->getAdminData($adminID);
        ?>
            <div class="row text-center">
            <h3>Account Details</h3>
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>Username</td>
                        <td><?php echo $admin['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Email Address</td>
                        <td><?php echo $admin['email'] ?></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $admin['firstName'] ?></td>
                    </tr>
                    <tr>
                        <td>Surname</td>
                        <td><?php echo $admin['lastName'] ?></td>
                    </tr>
                </tbody>
            </table>    
            </div>
    </div>
<div class="col-lg-3"></div>
</div>
</div>
</div>
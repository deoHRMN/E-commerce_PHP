<?php 
    include("../includes/connect.php");
    include("../models/OrderModel.php");
    include("../controllers/OrderController.php");
    include("../models/UserModel.php");
    include("../controllers/UserController.php");

    $userModel = new UserModel($db);
    $userController = new UserController($userModel);
    $orderModel = new OrderModel($db);
    $orderController = new OrderController($orderModel);

    $orders = $orderController->viewAllOrders();

    if(isset($_POST['action']) && $_POST['action'] == "updateStatus") {
        if($_POST['status'] != "") {
            $orderController->changeOrderStatus($_POST['orderID'], $_POST['status']);
            echo "<script>locaiton.reload();</script>";
        }
    }

?>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="row text-center">
            <h3> Order Details</h3>
            <table class="table table-hover mt-2">
                <thead>
                    <th>orderID</th>
                    <th>Customer Email</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Current Status</th>
                    <th>View Order Products</th>
                </thead>
                <tbody>
                <?php 
                    $statuses = $orderController->getStatuses();
                    if (isset($orders) && $orders != null) {
                        foreach($orders as $order) {
                            $user = $userController->getUserData($order['userID']);
                            $currentStatus = $orderController->getOrderStaus($order['orderID']);
                            echo'
                                <tr>
                                    <td>'.$order['orderID'].'</td>
                                    <td>'.$user['email'].'</td>
                                    <td>'.$order['totalAmount'].'</td>
                                    <td>'.$order['orderDate'].'</td>
                                    <td>'.$currentStatus.'</td>
                                    <td class="d-flex">
                                    <form action="" method="POST">
                                    <select name="status" class="form-select" required>
                                    <option value="">Select Order Status</option>';
                                    foreach($statuses as $status) {
                                            echo '<option value="'.$status['statusCode'].'">'.$status['statusName'].'</option>';
                                        }
                                    echo '</select>
                                    <input type="hidden" name="action" value="updateStatus">
                                    <input type="hidden" name="orderID" value="'.$order['orderID'].'">
                                    <input type="submit" value="Update" class="btn btn-success"></input>
                                    </form></td>
                                    <td><a href="orderDetails.php?orderID='.$order['orderID'].'" class="btn btn-info m-2">View Order Products</a></td>
                                </tr>
                            ';
                                    } 
                    } else {
                        echo "<h4>No Orders at the moment.</h4>";
                    }
 
                ?>
                </tbody>
        </table>    
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>
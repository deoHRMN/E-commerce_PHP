<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Store Php - Manage Orders</title>
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
        <div class="container mt-5 mb-5 text-center">
        <?php
            include("./models/OrderModel.php");
            include("./controllers/OrderController.php");

            $orderModel = new OrderModel($db);
            $orderController = new OrderController($orderModel);
            if(isset($_GET['action']) && $_GET['action'] == "cancelOrder"){
                $orderController->changeOrderStatus($_GET['orderID'], 3);
                
            }
                
            if(isset($_SESSION['user'])) {
                $userID = $_SESSION['user'];
                $orders = $orderController->getOrders($userID);
                if(count($orders) > 0) { ?>
                    <div class="row">
                        <table class="table-bordered  text-center">
                            <thead>
                                <th>OrderID</th>
                                <th>Total Amount</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($orders as $order) {?>  
                                    <tr>
                                        <td class="p-2"><?php echo $order['orderID']?></td>
                                        <td class="p-2">CAD <?php echo $order['totalAmount']?></td>
                                        <td class="p-2"><?php echo $order['orderDate']?></td>
                                        <td class="p-2"><?php echo $orderController->getOrderStaus($order['orderID'])?></td>
                                        <?php if (($order['statusCode']!= 3) && ($order['statusCode']!= 2)) { ?>
                                        <td class="p-2 d-flex"><form action="" method="get">
                                        <input type="hidden" name="orderID" value="<?php echo $order['orderID']?>">
                                        <input type="hidden" name="action" value="cancelOrder">
                                        <input type="submit" value="Cancel" class="btn btn-danger m-2">
                                        </form>
                                        <a href="orderDetails.php?orderID=<?php echo $order['orderID']?>" class="btn btn-info m-2">View Order Products</a></td>
                                    </tr>
                                <?php } else { ?> 
                                        <td><a href="orderDetails.php?orderID=<?php echo $order['orderID']?>" class="btn btn-info m-2">View Order Products</a></td>
                                <?php }}} else {echo '
                                <img src="../images/emptyCart.png" style="width:100%; height:300px; object-fit: contain" alt="empty Cart">
                                <br>
                                <h4>No Orders.</h4>';?>
                                </tbody>
                            </table>
        <?php }}?>
                    </div>
        </div>
        </div>
    </div>
 


    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

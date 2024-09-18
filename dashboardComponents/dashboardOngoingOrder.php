<?php
require_once ('../components/connect2.php');


session_start();
$orderQuery = mysqli_query($conn2, "SELECT * FROM orders WHERE status='on going'");

error_reporting(0);

session_start();
if ($_SESSION['deliver'] != 'deliver') {
    echo "<script>window.location.href='deliverPortal.php'</script>";
} else if (empty($_SESSION['deliver'])) {
    echo "<script>window.location.href='deliverPortal.php'</script>";
}



if (isset($_POST['signoutDeliver'])) {
    // $warning_msg[] = 'Invalid username or password!';

    if (empty($_SESSION['deliver']) || $_SESSION['deliver'] != 'deliver') {
        $warning_msg[] = 'Delivery Account Not Active';
    } else {
        $_SESSION['deliver'] = null;
        echo "<script>window.location.href='deliverPortal.php'</script>";
    }
}




if (isset($_POST['orderIDDelivered'])) {

    $id = $_POST['orderIDDelivered'];


    // check if not already delivered
    $check = mysqli_query($conn2, "SELECT * FROM orders WHERE id='$id'");
    $checkFetch = mysqli_fetch_array($check);

    mysqli_query($conn2, "UPDATE orders SET status='delivered' WHERE id='$id'");
    $success_msg[] = "Successfully Delivered";


}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <!-- google icons -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />

    <!-- css -->
    <link
        rel="stylesheet"
        href="./css/dashboardOrder.css"
    >

    <title>Order | Dashboard</title>
</head>

<body>

    <form
        id="signoutCon"
        action=""
        method="POST"
    >

        <button
            name="signoutDeliver"
            class="Btn signoutDeliver"
        >

            <div class="sign"><svg viewBox="0 0 512 512">
                    <path
                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                    >
                    </path>
                </svg></div>

            <div class="text">Logout</div>
        </button>



    </form>



    <h1>On Going Order</h1>
    <a
        style="color:grey;text-decoration:none;font-size:1.3rem;margin-left:1rem;"
        href="dashboardOrder.php"
    >Orders</a>
    <a
        style="color:grey;text-decoration:none;font-size:1.3rem;margin-left:1rem;border-bottom:2px solid grey;"
        href="dashboardOngoingOrder.php"
    >On Going Orders</a>
    <a
        style="color:red;text-decoration:none;font-size:1.3rem;margin-left:1rem;"
        href="dashboardCancelOrder.php"
    >Canceled Order</a>
    <a
        style="color:green;text-decoration:none;font-size:1.3rem;margin-left:1rem;"
        href="dashboardSuccessOrder.php"
    >Success Order</a>


    <table>

        <thead>
            <th>Order ID</th>
            <th>Order</th>
            <th>Buyer Name</th>
            <th>Buyer Number</th>
            <th>Buyer Email</th>
            <th>Buyer Address</th>
            <th>Address Type</th>
            <th>Method</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <th>Order Status</th>
        </thead>


        <?php while ($fetchOrder = mysqli_fetch_array($orderQuery)) { ?>

        <tr>
            <td><?php echo $fetchOrder['id']; ?></td>
            <td><?php echo $fetchOrder['order_name']; ?></td>
            <td><?php echo $fetchOrder['name']; ?></td>
            <td><?php echo $fetchOrder['number']; ?></td>
            <td><?php echo $fetchOrder['email']; ?></td>
            <td><?php echo $fetchOrder['address']; ?></td>
            <td><?php echo $fetchOrder['address_type']; ?></td>
            <td><?php echo $fetchOrder['method']; ?></td>
            <td><?php echo $fetchOrder['price']; ?></td>
            <td><?php echo $fetchOrder['qty']; ?></td>
            <td><?php echo $fetchOrder['date']; ?></td>
            <td>
                <?php if ($fetchOrder['transaction_status'] == "on going") { ?>
                <p>Waiting for Payment</p>
                <?php } else { ?>
                <form
                    action=""
                    method="POST"
                >
                    <input
                        type="hidden"
                        name="orderIDDelivered"
                        value="<?php echo $fetchOrder['id']; ?>"
                    >
                    <button
                        type="submit"
                        name="deliverNow"
                        id="deliverNow"
                    >Deliver Now</button>
                </form>
                <?php } ?>
            </td>
        </tr>

        <?php } ?>

    </table>


</body>
<script>
// check if have theme
if (localStorage.getItem("theme") === "" || localStorage.getItem("theme") === null) {
    localStorage.setItem("theme", "#fff");
} else if (localStorage.getItem("theme") === "#fff") {
    document.body.style.background = "#fff";
} else if (localStorage.getItem("theme") === "#000") {
    document.body.style.background = "#000";
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alert.php'; ?>

</html>
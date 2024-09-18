<?php
session_start();

// Check if the user is logged in and is MainAdmin
if (!isset($_SESSION['accType']) || $_SESSION['accType'] !== "MainAdmi") {
    header("Location: ./portal.php");
    exit();
}

// Database connection
require_once('../components/connect2.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $age = $_POST['age'];

    $updateQuery = "UPDATE delivery_user SET dfullname=?, dusername=?, dage=? WHERE delivery_user_id=?";
    $stmt = mysqli_prepare($conn2, $updateQuery);

    if ($stmt === false) {
        die("Error preparing update statement: " . mysqli_error($conn2));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssii", $name, $username, $age, $id);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        header("Location: admin_accounts_view.php?filter=DeliveryUser");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn2);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Get the delivery user account details
$id = $_GET['id'];
$deliveryUserQuery = "SELECT delivery_user_id, dfullname, dusername, dage FROM delivery_user WHERE delivery_user_id=?";
$stmt = mysqli_prepare($conn2, $deliveryUserQuery);

if ($stmt === false) {
    die("Error preparing select statement: " . mysqli_error($conn2));
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute statement
if (mysqli_stmt_execute($stmt)) {
    // Bind result variables
    mysqli_stmt_bind_result($stmt, $delivery_user_id, $dfullname, $dusername, $dage);

    // Fetch the data
    mysqli_stmt_fetch($stmt);

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    die("Error fetching delivery user details: " . mysqli_error($conn2));
}

// Close connection
mysqli_close($conn2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Delivery User Account</title>
    <link rel="stylesheet" href="./css/add_admin_account.css"> <!-- Use the same CSS as add_delivery_user.php -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <span style="position: fixed; top: 3rem; left: 2rem; font-size: 3rem; padding: 1rem 0; cursor: pointer; color: #634d4d;" onClick="window.location.href='admin_accounts_view.php?filter=DeliveryUser';" class="material-symbols-outlined">
        arrow_back
    </span>

    <main class="main">
        <div class="portal">
            <form class="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Edit Delivery User Account</h2>

                <input type="hidden" name="id" value="<?php echo $delivery_user_id; ?>">
                
                <div class="inputGroup">
                    <input id="nameRegister" type="text" name="name" value="<?php echo htmlspecialchars($dfullname); ?>" required autocomplete="off">
                    <label for="name">Name</label>
                </div>

                <div class="inputGroup">
                    <input id="usernameRegister" type="text" name="username" value="<?php echo htmlspecialchars($dusername); ?>" required autocomplete="off">
                    <label for="username">Username</label>
                </div>

                <div class="inputGroup">
                    <input id="ageRegister" type="number" name="age" value="<?php echo htmlspecialchars($dage); ?>" required autocomplete="off">
                    <label for="age">Age</label>
                </div>

                <button type="submit" class="submitRegister">Update</button>
            </form>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/add_admin_account.js"></script>
</body>
</html>

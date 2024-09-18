<?php
session_start();

// Check if the user is logged in and is MainAdmin
if (!isset($_SESSION['accType']) || $_SESSION['accType'] !== "MainAdmi") {
    header("Location: ./portal.php");
    exit();
}

// Database connection
require_once('../components/connect2.php');

// Get the account ID
$id = $_GET['id'];

// Delete the delivery user account
$deleteQuery = "DELETE FROM delivery_user WHERE delivery_user_id=?";
$stmt = mysqli_prepare($conn2, $deleteQuery);

if ($stmt === false) {
    echo "Error preparing delete statement: " . mysqli_error($conn2);
} else {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        header("Location: admin_accounts_view.php?filter=DeliveryUser");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn2);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn2);
?>

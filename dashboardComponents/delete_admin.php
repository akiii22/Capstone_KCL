<?php
session_start();

// Check if the user is logged in and is MainAdmin
if (!isset($_SESSION['accType']) || $_SESSION['accType'] !== "MainAdmi") {
    // Redirect them if not MainAdmin
    header("Location: ../portal.php");
    exit();
}

// Database connection
require_once('../components/connect2.php');

// Check if ID parameter is present
if (!isset($_GET['id'])) {
    die("ID parameter missing.");
}

$id = $_GET['id'];

// Prepare SQL statement
$deleteQuery = "DELETE FROM accounts WHERE account_id = ?";

$stmt = mysqli_prepare($conn2, $deleteQuery);

if ($stmt === false) {
    die("Error preparing delete statement: " . mysqli_error($conn2));
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute statement
if (mysqli_stmt_execute($stmt)) {
    // Redirect to admin_accounts_view.php after successful delete
    header("Location: ../dashboardComponents/admin_accounts_view.php?filter=Admin");
    exit();
} else {
    die("Error deleting record: " . mysqli_error($conn2));
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn2);
?>

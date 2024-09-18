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

// Fetch current admin details
$fetchQuery = "SELECT account_name, account_username, account_email, account_contact_num FROM accounts WHERE account_id = ?";
$stmt = mysqli_prepare($conn2, $fetchQuery);

if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($conn2));
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute statement
if (mysqli_stmt_execute($stmt)) {
    // Bind result variables
    mysqli_stmt_bind_result($stmt, $account_name, $account_username, $account_email, $account_contact_num);

    // Fetch the data
    mysqli_stmt_fetch($stmt);
} else {
    die("Error fetching admin details: " . mysqli_error($conn2));
}

// Close statement
mysqli_stmt_close($stmt);

// Handle form submission for updating admin details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $new_name = $_POST['new_name'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_contact_num = $_POST['new_contact_num'];

    // Update query
    $updateQuery = "UPDATE accounts SET account_name = ?, account_username = ?, account_email = ?, account_contact_num = ? WHERE account_id = ?";
    $stmt = mysqli_prepare($conn2, $updateQuery);

    if ($stmt === false) {
        die("Error preparing update statement: " . mysqli_error($conn2));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssi", $new_name, $new_username, $new_email, $new_contact_num, $id);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to admin_accounts_view.php after successful update
        header("Location: ../dashboardComponents/admin_accounts_view.php?filter=Admin");
        exit();
    } else {
        die("Error updating record: " . mysqli_error($conn2));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Account</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/add_admin_account.css">
    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>
<body>
    <span style="position: fixed; top: 3rem; left: 2rem; font-size: 3rem; padding: 1rem 0; cursor: pointer; color: #634d4d;" onClick="window.location.href='../dashboardComponents/admin_accounts_view.php?filter=Admin';" class="material-symbols-outlined">
        arrow_back
    </span>

    <main class="main">
        <div class="portal">
            <form class="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="POST">
                <h2>Edit Admin Account</h2>

                <div class="inputGroup">
                    <input id="nameRegister" type="text" name="new_name" value="<?php echo htmlspecialchars($account_name); ?>" required>
                    <label for="name">Name</label>
                </div>

                <div class="inputGroup">
                    <input id="usernameRegister" type="text" name="new_username" value="<?php echo htmlspecialchars($account_username); ?>" required>
                    <label for="username">Username</label>
                </div>

                <div class="inputGroup">
                    <input id="emailRegister" type="email" name="new_email" value="<?php echo htmlspecialchars($account_email); ?>" required>
                    <label for="email">Email</label>
                </div>

                <div class="inputGroup">
                    <input id="numberRegister" type="text" name="new_contact_num" value="<?php echo htmlspecialchars($account_contact_num); ?>" required>
                    <label for="number">Mobile Number</label>
                </div>

                <button type="submit" class="submitRegister">Update Account</button>
            </form>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/add_admin_account.js"></script>
</body>
</html>

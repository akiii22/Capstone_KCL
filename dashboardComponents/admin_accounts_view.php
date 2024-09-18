<?php
session_start();

// Check if the user is logged in and is MainAdmin
if (!isset($_SESSION['accType']) || $_SESSION['accType'] !== "MainAdmi") {
    // Redirect them if not MainAdmin
    header("Location: ./portal.php");
    exit();
}

// Database connection
require_once('../components/connect2.php');

// Default to showing Admin accounts
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'Admin';

// Fetch admin accounts
$adminAccounts = [];
if ($filter === 'Admin') {
    $adminAccountsQuery = "SELECT account_id, account_name, account_username, account_email, account_contact_num FROM accounts WHERE account_type = 'Admin'";
    $adminAccountsResult = mysqli_query($conn2, $adminAccountsQuery);

    if (!$adminAccountsResult) {
        die("Error fetching admin accounts: " . mysqli_error($conn2));
    }

    $adminAccounts = mysqli_fetch_all($adminAccountsResult, MYSQLI_ASSOC);
} elseif ($filter === 'DeliveryUser') {
    // Fetch delivery user accounts
    $deliveryUserAccountsQuery = "SELECT delivery_user_id AS id, dfullname AS fullname, dusername AS username, dage AS age FROM delivery_user";
    $deliveryUserAccountsResult = mysqli_query($conn2, $deliveryUserAccountsQuery);

    if (!$deliveryUserAccountsResult) {
        die("Error fetching delivery user accounts: " . mysqli_error($conn2));
    }

    $adminAccounts = mysqli_fetch_all($deliveryUserAccountsResult, MYSQLI_ASSOC);
}

// Close connection
mysqli_close($conn2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin and Delivery User Accounts</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/admin_accounts.css">
    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <span style="position: fixed; top: 3rem; left: 2rem; font-size: 3rem; padding: 1rem 0; cursor: pointer; color: #634d4d;" onClick="window.location.href='../main_admin_dashboard.php';" class="material-symbols-outlined">
        arrow_back
    </span>

    <main class="main">
        <div class="portal">
            <h2>Admin and Delivery User Accounts</h2>

            <!-- Filter Buttons -->
            <div class="filter-buttons">
                <a href="?filter=Admin" class="btn <?php echo $filter === 'Admin' ? 'active' : ''; ?>">Admin Accounts</a>
                <a href="?filter=DeliveryUser" class="btn <?php echo $filter === 'DeliveryUser' ? 'active' : ''; ?>">Delivery User Accounts</a>
            </div>

            <div class="accounts">
                <?php if ($filter === 'Admin'): ?>
                    <div class="admin-accounts">
                        <h3>Admin Accounts</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($adminAccounts as $admin): ?>
                                    <tr>
                                        <td><?php echo $admin['account_name']; ?></td>
                                        <td><?php echo $admin['account_username']; ?></td>
                                        <td><?php echo $admin['account_email']; ?></td>
                                        <td><?php echo $admin['account_contact_num']; ?></td>
                                        <td>
                                            <a href="../dashboardComponents/edit_admin.php?id=<?php echo $admin['account_id']; ?>" class="btn edit-btn">Edit</a>
                                            <a href="../dashboardComponents/delete_admin.php?id=<?php echo $admin['account_id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this account?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php elseif ($filter === 'DeliveryUser'): ?>
                    <div class="delivery-user-accounts">
                        <h3>Delivery User Accounts</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Age</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($adminAccounts as $deliveryUser): ?>
                                    <tr>
                                        <td><?php echo $deliveryUser['fullname']; ?></td>
                                        <td><?php echo $deliveryUser['username']; ?></td>
                                        <td><?php echo $deliveryUser['age']; ?></td>
                                        <td>
                                            <a href="../dashboardComponents/edit_delivery_user.php?id=<?php echo $deliveryUser['id']; ?>" class="btn edit-btn">Edit</a>
                                            <a href="../dashboardComponents/delete_delivery_user.php?id=<?php echo $deliveryUser['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this account?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>

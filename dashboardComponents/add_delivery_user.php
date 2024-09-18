<?php
require_once('../components/connect2.php');

session_start();
if ($_SESSION['accType'] != "MainAdmi") {
    echo "<script>window.location.href='../portal.php'</script>";
} else if (empty($_SESSION['accType']) || $_SESSION['accType'] == "") {
    $_SESSION['accType'] = "";
    echo "<script>window.location.href='../portal.php'</script>";
}

if (isset($_POST['addUser'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Ensure to use more secure password hashing methods in production
    $age = $_POST['age'];
    $accType = 'deliver'; // Fixed value for delivery user

    if (!empty($fullname) && !empty($username) && !empty($password) && !empty($age)) {
        $query = "INSERT INTO delivery_user (dfullname, dusername, dpassword, dage, accType) VALUES ('$fullname', '$username', '$password', '$age', '$accType')";
        if (mysqli_query($conn2, $query)) {
            $success_msg = 'Successfully Added!';
        } else {
            $warning_msg = 'Error adding user: ' . mysqli_error($conn2);
        }
    } else {
        $warning_msg = 'All fields are required!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Delivery User</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/add_admin_account.css">
    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    
    <span style="position: fixed; top: 3rem; left: 2rem; font-size: 3rem; padding: 1rem 0; cursor: pointer; color: #634d4d;" onClick="window.location.href='../dashboard.php';" class="material-symbols-outlined">
        arrow_back
    </span>

    <main class="main">
        <div class="portal">
            <form class="register" action="" method="POST">
                <h2>Add Delivery User</h2>
                <?php if (isset($warning_msg)): ?>
                    <small style="color: red;" class="regErr"><?php echo $warning_msg; ?></small>
                <?php endif; ?>
                <?php if (isset($success_msg)): ?>
                    <small style="color: green;" class="regSuccess"><?php echo $success_msg; ?></small>
                <?php endif; ?>
                <div class="inputGroup">
                    <input id="nameRegister" type="text" name="fullname" required autocomplete="off">
                    <label for="name">Name</label>
                </div>

                <div class="inputGroup">
                    <input id="usernameRegister" type="text" name="username" required autocomplete="off">
                    <label for="username">Username</label>
                </div>

                <div class="inputGroup">
                    <span id="eyeReg" class="material-symbols-outlined">
                        visibility
                    </span>
                    <input id="passRegister" type="password" name="password" required autocomplete="off">
                    <label for="password">Password</label>
                </div>

                <div class="inputGroup">
                    <input id="ageRegister" type="number" name="age" required autocomplete="off">
                    <label for="age">Age</label>
                </div>

                <button type="submit" name="addUser" class="submitRegister">Sign Up</button>
            </form>
        </div>
    </main>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./js/add_admin_account.js"></script>

</html>

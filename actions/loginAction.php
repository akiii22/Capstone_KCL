<?php
require ('./config/config.php');

if (isset($_POST['usernameLogin'])) {

    $usernameLogin = $conn->real_escape_string($_POST['usernameLogin']);
    $passLogin = $conn->real_escape_string($_POST['passLogin']);
    $passLogin = md5($passLogin);

    $selectLogin = $conn->real_escape_string($_POST['selectLogin']);

    // validate
    if (empty($usernameLogin) || empty($passLogin) || $selectLogin != "User") {
        echo "<script>
                loginErr.text('Sorry, we are encountering an error...');
                setTimeout(()=>{
                    location.reload();
                },2000);
              </script>";
    } else {
        // check if exist
        $checkLogin = mysqli_query($conn, "SELECT account_name FROM accounts WHERE account_username = '$usernameLogin' AND account_pass = '$passLogin'");

        // get account type
        $accType = mysqli_query($conn, "SELECT account_type,account_id FROM accounts WHERE account_username = '$usernameLogin' AND account_pass = '$passLogin'");
        $accTypeFetch = mysqli_fetch_array($accType);

        // get name
        $getName = mysqli_fetch_array($checkLogin);
        if (mysqli_num_rows($checkLogin) > 0) {

            session_start();
            $_SESSION['profName'] = $getName['account_name'];

            $_SESSION['accType'] = $accTypeFetch['account_type'];
            $_SESSION['accID'] = $accTypeFetch['account_id'];

            if ($_SESSION['accType'] == 'Admin') {
                echo "<script>window.location.href='./dashboard.php'</script>";
            } else if ($_SESSION['accType'] == 'User') {
                echo "<script>window.location.href='./view_products.php'</script>";
            } else {
                echo "<script>window.location.href='./dashboard.php'</script>";
            }

        } else {
            echo "Invalid username or password or account type.";
        }
    }
}
?>
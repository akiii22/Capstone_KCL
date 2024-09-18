<?php
require_once('./config/config.php');

if(isset($_POST['forgotUname'])){

    $forgotUname = $conn->real_escape_string($_POST['forgotUname']);

    $forgotKey = $conn->real_escape_string($_POST['forgotKey']);

    $forgotNewPassword = md5($conn->real_escape_string($_POST['forgotNewPassword']));

    $forgotAccType = $conn->real_escape_string($_POST['forgotAccType']);
    
    
    
    if(empty($forgotUname)||empty($forgotKey)||empty($forgotAccType)||empty($forgotNewPassword)){
        echo"Invalid data";
    }else{

        $checkForgot = mysqli_query($conn, "SELECT * FROM accounts WHERE account_username='$forgotUname' AND account_secret_key='$forgotKey' AND account_type='$forgotAccType'");

        if(mysqli_num_rows($checkForgot)==1){
            mysqli_query($conn,"UPDATE `accounts` SET account_pass='$forgotNewPassword' WHERE account_username='$forgotUname'");

            echo"Successfully update your account.";
        }else{
            echo"Invalid data";
        }

    }


}

?>
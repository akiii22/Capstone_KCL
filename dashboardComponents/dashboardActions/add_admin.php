<?php
require_once('../../actions/config/config.php');

if(isset($_POST['nameRegister'])){

    $nameRegister = $conn->real_escape_string($_POST['nameRegister']);
    $usernameRegister = $conn->real_escape_string($_POST['usernameRegister']);
    $passRegister = md5($conn->real_escape_string($_POST['passRegister']));
    $addressRegister = $conn->real_escape_string($_POST['addressRegister']);
    $numberRegister = $conn->real_escape_string($_POST['numberRegister']);
    $secretKey = $conn->real_escape_string($_POST['secretKey']);
    $selectRegister = $conn->real_escape_string($_POST['selectRegister']);

    // validate
    if(empty($nameRegister)||strlen($nameRegister)<3||strlen($nameRegister)>29|| empty($usernameRegister)||strlen($usernameRegister)<4||strlen($usernameRegister)>19||empty($passRegister)||strlen($passRegister)<6||strlen($passRegister)>100||empty($addressRegister)|| strlen($addressRegister)>90|| empty($numberRegister)||strlen($numberRegister)!=11|| strlen($secretKey)>200||$selectRegister!="Admin"){
        echo "9f3a57516524c7cdfece8b719693a01f";
    }else{
        
            // check if exist
            $checkExist = mysqli_query($conn,"SELECT * FROM accounts WHERE account_username = '$usernameRegister'");
            if(mysqli_num_rows($checkExist) ==1 ||mysqli_num_rows($checkExist) >0){
                echo "<script>
                $('.regErr').text('Username already exist. Please choose another.');
                setTimeout(()=>{
                    $('.regErr').text('');
                },3000);
                </script>";
            }else{
                // if not
                echo "<script>
                $('.regErr').css('color','#00E77F').text('Success! Please wait..');
                setTimeout(()=>{
                    location.reload();
                },2000);
                </script>";
                $insertUsernameRegister = mysqli_query($conn,"INSERT INTO accounts(account_name,account_username,account_pass,account_address,account_contact_num,account_secret_key,account_type) VALUES('$nameRegister','$usernameRegister','$passRegister','$addressRegister','$numberRegister','$secretKey','$selectRegister')");

            }


    }



}



?>
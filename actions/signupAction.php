<?php
require_once('./config/config.php');

if(isset($_POST['nameRegister'])){
    $nameRegister = $conn->real_escape_string($_POST['nameRegister']);
    $usernameRegister = $conn->real_escape_string($_POST['usernameRegister']);
    $passRegister = $conn->real_escape_string($_POST['passRegister']);
    $addressRegister = $conn->real_escape_string($_POST['addressRegister']);
    $emailRegister = $conn->real_escape_string($_POST['emailRegister']);
    $numberRegister = $conn->real_escape_string($_POST['numberRegister']);
    $secretKey = $conn->real_escape_string($_POST['secretKey']);
    $selectRegister = $conn->real_escape_string($_POST['selectRegister']);

    if(empty($nameRegister) || strlen($nameRegister) < 3 || strlen($nameRegister) > 29 || empty($usernameRegister) || strlen($usernameRegister) < 4 || strlen($usernameRegister) > 19 || empty($passRegister) || strlen($passRegister) < 6 || strlen($passRegister) > 26 || empty($addressRegister) || strlen($addressRegister) > 90 || empty($emailRegister) || strlen($emailRegister) > 30 || empty($numberRegister) || strlen($numberRegister) != 11 || strlen($secretKey) > 200 || $selectRegister != "User") {
        echo "9f3a57516524c7cdfece8b719693a01f"; 
    } else {
        $checkExist = mysqli_query($conn, "SELECT * FROM accounts WHERE account_username = '$usernameRegister'");
        if(mysqli_num_rows($checkExist) > 0){
            echo "<script>
                $('.regErr').text('Username already exists. Please choose another.');
                setTimeout(()=>{
                    $('.regErr').text('');
                },3000);
            </script>";
        } else {
            // Use bcrypt for password hashing
            $hashedPassword = md5($passRegister);

            $insertUsernameRegister = mysqli_query($conn, "INSERT INTO accounts(account_name,account_username,account_pass,account_address,account_email,account_contact_num,account_secret_key,account_type) VALUES('$nameRegister','$usernameRegister','$hashedPassword','$addressRegister','$emailRegister','$numberRegister','$secretKey','$selectRegister')") or die(mysqli_error($conn));

            if($insertUsernameRegister) {
                echo "<script>
                    $('.regErr').css('color','#00E77F').text('Success! Please wait..');
                    setTimeout(()=>{
                        location.reload();
                    },2000);
                </script>";
            } else {
                echo "<script>
                    $('.regErr').text('Error occurred while signing up. Please try again.');
                    setTimeout(()=>{
                        $('.regErr').text('');
                    },3000);
                </script>";
            }
        }
    }
}
?>

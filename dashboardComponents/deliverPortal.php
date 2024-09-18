<?php 

error_reporting(0);


// $success_msg[] = 'Successfully Updated!';
require_once('../components/connect2.php');

session_start();
   if($_SESSION['deliver'] == "deliver"){
       echo"<script>window.location.href='dashboardOrder.php'</script>";
   }






if(isset($_POST['deliverSub'])){
    

  $username = $_POST['username'];
   $password =  md5($_POST['password']);

    if(!empty($username) && !empty($password)){

        // check
        $checkQuery = mysqli_query($conn2,"SELECT * FROM delivery_user WHERE dusername='$username' AND dpassword='$password'");

        $checkFetch = mysqli_fetch_array($checkQuery);
        

        if(mysqli_num_rows($checkQuery) > 0){

            header('Location: dashboardOrder.php');

            session_start();
           $_SESSION['deliver'] = $checkFetch['accType'];
            
        }else{
            $warning_msg[] = 'Invalid username or password!';
        }

    }else{
        $warning_msg[] = 'Invalid username or password!';
    }

}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliver Portal</title>
    <link rel="stylesheet" href="./css/deliverPortal.css">
</head>

<body>


    <main>

        <h1>Deliver Portal</h1>

        <section class="container">

            <form action="" method="POST">
                <span>
                    <label for="username">Username</label>
                    <input type="text" name="username">
                </span>

                <span>
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    <button name="deliverSub" type="submit">Sign in</button>
                </span>

            </form>


        </section>

    </main>




</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alert.php'; ?>

</html>
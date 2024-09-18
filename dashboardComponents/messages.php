<?php



error_reporting(0);

   session_start();
   if($_SESSION['accType2'] != "Admin"){
       echo"<script>window.location.href='../portal.php'</script>";
   }else if(empty($_SESSION['accType2']) || $_SESSION['accType2']==""){
       $_SESSION['accType'] = "";
       echo"<script>window.location.href='../portal.php'</script>";
   
   }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>
</body>
</html>
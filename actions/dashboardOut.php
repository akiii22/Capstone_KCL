<?php

if(isset($_POST['signout'])){

    session_start();
    $_SESSION['accType'] = "";
    $_SESSION['profName'] = "";
    $_SESSION['accID'] = "";
    echo"<script>window.location.href='./portal.php'</script>";
}

?>
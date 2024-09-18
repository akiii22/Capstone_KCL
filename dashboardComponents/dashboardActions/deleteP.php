<?php
require_once('../../components/connect2.php');

if(isset($_POST['getId'])){

$getId = $_POST['getId'];

echo"Successfully Deleted";
mysqli_query($conn2,"DELETE FROM products WHERE id='$getId'");


}

?>
<?php

error_reporting(0);

session_start();
if($_SESSION['accType'] != "Admin"){
    echo"<script>window.location.href='../portal.php'</script>";
}else if(empty($_SESSION['accType']) || $_SESSION['accType']==""){
    $_SESSION['accType'] = "";
    echo"<script>window.location.href='../portal.php'</script>";

}


?>

<?php

include '../components/connect.php';
require_once('../components/connect2.php');

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}


if(isset($_POST['productId'])){

   $productId = $_POST['productId'];
 
   $nameP = $_POST['nameP'];
    $nameP = filter_var($nameP, FILTER_SANITIZE_STRING);
 
    $priceP = $_POST['priceP'];
    $priceP = filter_var($priceP, FILTER_SANITIZE_STRING);
 
    $stocksP = $_POST['stocksP'];
    $stocksP = filter_var($stocksP,FILTER_SANITIZE_NUMBER_INT);
 
 
    $product_infoP = $_POST['product_infoP'];
    $product_specsP = $_POST['product_specsP'];
    $product_brandP = $_POST['product_brandP'];
 
 
   // get the files and name of image
    $imageP = $_FILES['imageP']['name'];
   //  sanitize string
    $imageP = filter_var($imageP, FILTER_SANITIZE_STRING);
   //  get image extension
    $ext = pathinfo($imageP, PATHINFO_EXTENSION);
   //  create unique image name and concatenate extension
    $rename = create_unique_id().'.'.$ext;

   //  set temporary name
    $image_tmp_name = $_FILES['imageP']['tmp_name'];

   //  set destination of folder concatenatenate the image with extension
    $image_folder = '../uploaded_files/'.$rename;

   //  get the size of image
   $image_size = $_FILES['imageP']['size'];
 
    if($image_size > 2000000){
      // check if the image is > 2000000
       $warning_msg[] = 'Image size is too large!';

    }else if($_FILES['imageP']['error'] == UPLOAD_ERR_NO_FILE){
         // check if image is empty


          // update
          mysqli_query($conn2,"UPDATE products SET name='$nameP',price='$priceP',stocks='$stocksP',product_info='$product_infoP',product_specs='$product_specsP',product_brand='$product_brandP' WHERE id='$productId'");

          
          
          $success_msg[] = 'Product Updated!';

          
    }else{

      // move uploaded files (Temporary_name,Image_Location)
      move_uploaded_file($image_tmp_name, $image_folder);

         // update
      mysqli_query($conn2,"UPDATE products SET name='$nameP',price='$priceP',stocks='$stocksP',product_info='$product_infoP',product_specs='$product_specsP',product_brand='$product_brandP',image='$rename' WHERE id='$productId'");

       
       $success_msg[] = 'Product Updated!';

      
       
   
    }
 
 }




?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plumbing Supply</title>

      <!-- swiper -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

   <!-- jquery -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <!-- css -->
   <link rel="stylesheet" href="./css/dPlumbingSupply.css">

   <!-- google icons -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />


</head>
<body>


<span style="position: fixed;top3rem;left:2rem;font-size:3rem;
padding: 1rem 0;cursor:pointer;color:#634d4d;" onClick="window.location.href='../dashboard.php';" class="material-symbols-outlined">
arrow_back
</span>


<div class="mess"></div>
<div class="confirmDel">
    <h2 id="pShowId"></h2>
    <span>
    <button class="delY">Yes</button>
    <button class="delN">No</button>
    </span>
</div>





<div class="editProductForm">
   
<span id="closeEdit" class="material-symbols-outlined">
close
</span>

 <h3>Edit Product</h3>

 <form class="editCon" action="" method="POST" enctype="multipart/form-data">



<!-- data -->



</form>



</div>




<section class="products">

   <span class="searchCon">

   <input type="text" name="searchProductES" placeholder="Search for electrical supply products with the name" id="searchProduct" class="searchProductES">

   </span>


   <div class="box-container ES">

   <?php 
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_specs='Electrical'");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="POST" class="box">
    <input style="margin-bottom:1rem;" disabled="true" id="productId" value="<?= $fetch_product['id']; ?>">
      <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
      <h3 class="name"><?= $fetch_product['name'] ?></h3>
      <h4 class="info">Product Info:         <?= $fetch_product['product_info'] ?></h4>
      <h5 class="specs">Product Brand:        <?= $fetch_product['product_brand'] ?></h5>
      <h3 class="specs">Stock: <?= $fetch_product['stocks'] ?></h3>
      <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
     
      <div class="flex">
      <p class="price"><i class="fas fa-money-bill-alt"></i> PHP <?= $fetch_product['price'] ?></p>
      </div>

      <span>
      <button class="edit" id="edit">Edit</button>
      <button class="delete" id="delete">Delete</button>
      </span>
      

      
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>




   


</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>





    <script src="./js/editDel.js"></script>
    <script src="./js/searchP.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include '../components/alert.php'; ?>
<script>

if(localStorage.getItem("theme")===""||localStorage.getItem("theme")===null){
    localStorage.setItem("theme","#fff");
}else if(localStorage.getItem("theme")==="#fff"){
    document.body.style.background="#fff";
}else if(localStorage.getItem("theme")==="#000"){
    document.body.style.background="#000";
}
</script>
</body>
</html>
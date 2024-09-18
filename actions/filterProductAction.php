<?php
include_once '../components/connect.php';

if(isset($_POST['filterVal'])){
   $filterVal = $_POST['filterVal'];
   if($filterVal == "All"){

      $select_products = $conn->prepare("SELECT * FROM products");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
    ?>

  
   <form action="" method="POST" class="box">
      <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
      <h3 class="name"><?= $fetch_product['name'] ?></h3>
      <h4 class="info">Product Info:         <?= $fetch_product['product_info'] ?></h4>
      <h5 class="specs">Product Brand:        <?= $fetch_product['product_brand'] ?></h5>
      <h3 class="specs">Stock: <?= $fetch_product['stocks'] ?></h3>
      <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
      <div class="flex">
      <p class="price"><i class="fas fa-money-bill-alt"></i> PHP <?= $fetch_product['price'] ?></p>
         <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
      </div>

      <span>
      <input type="submit" name="add_to_cart" value="add to cart" class="btn">
      <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="delete-btn">buy now</a>
      <a class="view_product" href="view_p.php?get_id=<?= $fetch_product['id']; ?>">View Product</a>
      </span>
      
   </form>
   
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }


   }
}


if(isset($_POST['filterVal'])){
    $filterVal = $_POST['filterVal'];
    
    $select_products = $conn->prepare("SELECT * FROM products WHERE product_specs='$filterVal'");
    $select_products->execute();
    if($select_products->rowCount() > 0){
       while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
  ?>


 <form action="" method="POST" class="box">
    <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
    <h3 class="name"><?= $fetch_product['name'] ?></h3>
    <h4 class="info">Product Info:         <?= $fetch_product['product_info'] ?></h4>
    <h5 class="specs">Product Brand:        <?= $fetch_product['product_brand'] ?></h5>
    <h3 class="specs">Stock: <?= $fetch_product['stocks'] ?></h3>
    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
    <div class="flex">
    <p class="price"><i class="fas fa-money-bill-alt"></i> PHP <?= $fetch_product['price'] ?></p>
       <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
    </div>

    <span>
      <input type="submit" name="add_to_cart" value="add to cart" class="btn">
      <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="delete-btn">buy now</a>
      <a class="view_product" href="view_p.php?get_id=<?= $fetch_product['id']; ?>">View Product</a>
      </span>

 </form>
 
 <?php
    }
 }else{
    echo '<p class="empty">no products found!</p>';
 }
 
 
}

?>
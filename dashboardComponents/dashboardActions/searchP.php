<?php
require_once('../../components/connect.php');




if(isset($_POST['searchProductPlumbing'])){
   $searchProductPlumbing = $_POST['searchProductPlumbing'];

    $select_products = $conn->prepare("SELECT * FROM products WHERE name LIKE '%$searchProductPlumbing%' AND product_specs='Plumbing'");
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
   
   <script src="./js/editDel.js"></script>

   <?php
  
      }

      
   }else{
      ?>

<p class="empty">No result</p>

      <?php
   }
     



   } //end if


   



   

   if(isset($_POST['searchProductCS'])){
       
      $searchProductCS = $_POST['searchProductCS'];
       $select_products = $conn->prepare("SELECT * FROM products WHERE name LIKE '%$searchProductCS%' AND product_specs='Construction'");
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
      
      <script src="./js/editDel.js"></script>
   
      <?php
     
         }
   
         
      }else{
         ?>
   
   <p class="empty">No result</p>
   
         <?php
      }
        
   
   
   
      } //end if
   








      if(isset($_POST['searchProductES'])){
       
         $searchProductES = $_POST['searchProductES'];
          $select_products = $conn->prepare("SELECT * FROM products WHERE name LIKE '%$searchProductES%' AND product_specs='Electrical'");
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
         
         <script src="./js/editDel.js"></script>
      
         <?php
        
            }
      
            
         }else{
            ?>
      
      <p class="empty">No result</p>
      
            <?php
         }
           
      
      
      
         } //end if











?>
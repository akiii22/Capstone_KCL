<?php
require_once('../components/connect.php');



if(isset($_POST['searchProduct'])){
    
   $searchProduct = $_POST['searchProduct'];
    $select_products = $conn->prepare("SELECT * FROM products WHERE name LIKE '%$searchProduct%'");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
    ?>
  
   <a href="view_p.php?get_id=<?= $fetch_product['id'];?>">
      <p><?= $fetch_product['name']; ?></p>
      <img src="uploaded_files/<?= $fetch_product['image'];?>" alt="><?= $fetch_product['name']; ?>">
   </a>
   
   <?php
      }
   }else{
        ?>
   
    <p class="empty">No result</p>
        
        <?php
    }
      
   }

?>
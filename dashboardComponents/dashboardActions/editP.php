<?php 
require('../../components/connect.php');
require('../../components/connect2.php');


if(isset($_POST['getIdEdit'])){

    $getIdEdit = $_POST['getIdEdit'];

    
   $queryEdit = mysqli_query($conn2,"SELECT * FROM products WHERE id='$getIdEdit'");

    $fetchEdit = mysqli_fetch_array($queryEdit)



        ?>


<input type="hidden" id="pType" value="<?php echo $fetchEdit['product_specs']; ?>">
<input type="hidden" id="pBrand" value="<?php echo $fetchEdit['product_brand'];?>">

<script>
  setTimeout(() => {
    $('#product_specsP').val($('#pType').val());
$('#product_brandP').val($('#pBrand').val());
  },100);

</script>

<input type="hidden" name="productId" id="productId" value="<?= $fetchEdit['id']; ?>">

<p>Product Name <span>*</span></p>
<input value="<?php echo $fetchEdit['name']; ?>" type="text" id="nameP" name="nameP" placeholder="Enter Product Name" required maxlength="50" class="box">

<p>Product Price <span>*</span></p>
<input value="<?php echo $fetchEdit['price'];?>" type="number" id="priceP" name="priceP" placeholder="Enter Product Price" required min="0" max="9999999999" maxlength="10" class="box">

<p>Product Stocks <span>*</span></p>
<input value="<?php echo $fetchEdit['stocks']; ?>" type="number" id="stocksP" name="stocksP" placeholder="Enter Product Stocks" required min="0" max="9999999999" maxlength="10" class="box">

<p>Product Image <span>*</span></p>
<input type="file" name="imageP" id="imageP" accept="image/*" class="box">
<p>Product Info</p>

<textarea name="product_infoP" id="product_infoP" placeholder="Enter Product Info" rows="4" cols="50"><?php echo $fetchEdit['product_info'];?></textarea>

<span>
<p>Product Type</p>
<select name="product_specsP" id="product_specsP">
  <option value="Plumbing">Plumbing</option>
  <option value="Electrical">Electrical</option>
  <option value="Construction">Construction</option>
</select>
<p>Product Brand</p>
<select  name="product_brandP" id="product_brandP">
   <option value="Reg-Brand">Reg Brand</option>
  <option value="Neltex">Neltex</option>
  <option value="Shark-Brand">Shark Brand</option>
  <option value="Maxtend">Maxtend</option>
  <option value="Jopex-Brand">Jopex Brand</option>
  <option value="Korea-Brand">Korea Brand</option>
  <option value="S40-Brand">S40 Brand</option>
  <option value="Hippo-Brand">Hippo Brand</option>
  <option value="Kopee">Kopee</option>
  <option value="Eagle">Eagle</option>
  <option value="Omni">Omni</option>
  <option value="Ruyo">Ruyo</option>
  <option value="Firefly">Firefly</option>
  <option value="Alpha">Alpha</option>
  <option value="Hook">Hook</option>
  <option value="Mega-One">Mega One</option>
  <option value="Amerilack">Amerilack</option>
  <option value="Stanley">Stanley</option>
  <option value="Welcoat">Welcoat</option>
  <option value="Taysan">Taysan</option>
</select>
</span>

<button type="submit" id="updateProduct">Update</button> 

    <?php
}







// edit isset
// if(isset($_POST['nameP'])){


// $nameP = mysqli_real_escape_string($conn2,$_POST['nameP']);
// $priceP = mysqli_real_escape_string($conn2,$_POST['priceP']);
// $stocksP = mysqli_real_escape_string($conn2,$_POST['stocksP']);
// $imageP = mysqli_real_escape_string($conn2,$_POST['imageP']);
// $product_infoP = mysqli_real_escape_string($conn2,$_POST['product_infoP']);
// $product_specsP = mysqli_real_escape_string($conn2,$_POST['product_specsP']);
// $product_brandP = mysqli_real_escape_string($conn2,$_POST['product_brandP']);



// if(){
//   echo"All input required";
// }else{
//    mysqli_query($conn2,"UPDATE products SET name='$nameP',price='$priceP',stocks='$stocksP',image='$imageP',product_info='$product_infoP',product_specs='$product_specsP',product_brand='$product_brandP'");

// }


// }


// update product


    //  $nameP = mysqli_real_escape_string($conn2,$_POST['nameP']);
    // $priceP = mysqli_real_escape_string($conn2,$_POST['priceP']);
    // $stocksP = mysqli_real_escape_string($conn2,$_POST['stocksP']);
    // $product_infoP = mysqli_real_escape_string($conn2,$_POST['product_infoP']);
    // $product_specsP = mysqli_real_escape_string($conn2,$_POST['product_specsP']);
    // $product_brandP = mysqli_real_escape_string($conn2,$_POST['product_brandP']);
    // $imageP = mysqli_real_escape_string($conn2,$_POST['imageP']);
    
    
      // $image = $_FILES['imageP']['nameP'];
      // $image = filter_var($image, FILTER_SANITIZE_STRING);
      // $ext = pathinfo($image, PATHINFO_EXTENSION);
      // $rename = $ext;
      // $image_tmp_name = $_FILES['imageP']['tmp_name'];
      // $image_size = $_FILES['imageP']['size'];
      // $image_folder = '../../uploaded_files/'.$rename;





  // if(empty($rename)||$rename==""){
     
  //   if($image_size > 2000000){
  //     echo"<script>
  //     $('.mess').html(`<h2>All input required</h2>`);
  //     setTimeout(()=>{location.reload();},2500);
  //     </script>";
  //   }else{
          //  $add_product = $conn->prepare("INSERT INTO `products`(id, name, price,stocks, product_info, product_specs, product_brand, image) VALUES(?,?,?,?,?,?,?,?)");
    //  $add_product->execute([$id, $name, $price,$stocks, $product_info, $product_specs, $product_brand, $rename]);
    

  //   mysqli_query("UPDATE products SET name='$name',price='$priceP',stocks='$stocksP',product_info='$product_infoP',product_specs='$product_specsP',product_brand='$product_brandP'");

  //   echo"<script>
  //   // $('.mess').html(`<h2>Successfully Updated!</h2>`);
  //   // setTimeout(()=>{location.reload();},2500);
  //   alert('Change with without image');
  //   </script>";
  //   }


  // }else{
  //   mysqli_query("UPDATE products SET name='$name',price='$priceP',stocks='$stocksP',product_info='$product_infoP',product_specs='$product_specsP',product_brand='$product_brandP',image='$rename'");

  //   // move
  //   move_uploaded_file($image_tmp_name, $image_folder);

  //   echo"<script>
  //   // $('.mess').html(`<h2>Successfully Updated!</h2>`);
  //   // setTimeout(()=>{location.reload();},2500);
  //   alert('Change with image');
  //   </script>";
  // }

?>
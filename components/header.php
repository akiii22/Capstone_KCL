
<header class="header">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <section class="flex">
        <a href="#" class="logo"><i class="fas fa-tools"></i>KCL</a>

        <nav class="navbar">
            <a href="./index.php"><i class="fas fa-home"></i> Home</a>
            <a href="view_products.php"><i class="fas fa-box-open"></i> Products</a>
            <a href="orders.php"><i class="fas fa-shopping-cart"></i> My Orders</a>
            <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE cart_for = ?");
                $count_cart_items->execute([$accID]);
                $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="shopping_cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to cart<span><?= $total_cart_items; ?></span></a>
            <a id="" href="#">
                <i class="fa-solid fa-user"></i> <?php echo $_SESSION['profName']; ?>
            </a>
            <a id="landingpageOut1"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
        </nav>


        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
</header>


<style>
.logo {
    font-size: 24px; 
    font-weight: bold;
    text-decoration: none;
    color: #7892eb; 
}

.logo i {
    margin-right: 5px; 
}

.logo:hover {
    color: #4562c6; 
}

</style>
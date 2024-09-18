<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin Account</title>
    <!-- css -->
   <link rel="stylesheet" href="./css/add_admin_account.css">
    <!-- google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    
<span style="position: fixed;top3rem;left:2rem;font-size:3rem;
padding: 1rem 0;cursor:pointer;color:#634d4d;" onClick="window.location.href='../dashboard.php';" class="material-symbols-outlined">
arrow_back
</span>


<main class="main">
    <div class="portal">

    <form class="register">
    
    <h2>Add Admin Account</h2>
    <small style="color: red" class="regErr"></small>
    <div class="inputGroup">
        <input id="nameRegister" type="text" required="" autocomplete="off">
        <label for="name">Name</label>
    </div>

    <div class="inputGroup">
        <input id="usernameRegister" type="text" required="" autocomplete="off">
        <label for="username">Usermame</label>
    </div>

    <div class="inputGroup">
        <span id="eyeReg" class="material-symbols-outlined">
            visibility
            </span>
        <input id="passRegister" type="password" required="" autocomplete="off">
        <label for="password">Password</label>
    </div>
    <div class="inputGroup">
        <span id="eyeReg" class="material-symbols-outlined">
            visibility
            </span>
        <input id="confirmPassRegister" type="password" required="" autocomplete="off">
        <label for="password"> Confirm Password</label>
    </div>
        

    <div class="inputGroup">
        <input id="addressRegister" type="text" required="" autocomplete="off">
        <label for="address">Address</label>
    </div>

    <div class="inputGroup">
        <input id="numberRegister" type="number" required="" autocomplete="off">
        <label for="mobile">Mobile number</label>
    </div>
    <div class="inputGroup">
    <input id="emailRegister" type="email" required="" autocomplete="off">
    <label for="email">Email</label>
</div>
    <div class="inputGroup">
        <input id="secretKey" type="text" required="" autocomplete="off">
        <label for="secretKey">Secret key</label>
    </div>

    <div class="select">
        <label for="select">Account type</label>
        <select name="select" id="selectRegister">
            <option>Admin</option>
        </select>
    </div>

    <button type="button" class="submitRegister">Sign Up</button>
        
</form>

    </div>
</main>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./js/add_admin_account.js"></script>

</html>
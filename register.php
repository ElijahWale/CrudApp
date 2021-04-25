<?php 
session_start();
include "registerprocess.php";
 ?>

<?php include "lib/header.php"; ?>
<body>
<div class="container">
        <h1>Register Page</h1>
        <!-- printing error and success message -->
        <?php
                if(isset($_SESSION['error']) &&  !empty($_SESSION['error'])){
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                }
        ?>
    
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="firstName" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="lastName" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" placeholder="">
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="forgotpassword.php">Forgot password</a>
        <a href="login.php">Login</a>
    </div>
    <?php include "lib/footer.php"; ?>
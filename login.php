<?php 
session_start();
include "loginprocess.php";
 ?>
<?php include "lib/header.php"; ?>
<body>
    <div class="container">

        <?php
            if(isset($_SESSION['success']) &&  !empty($_SESSION['success'])){
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
            }
        ?>

        <?php
            if(isset($_SESSION['error']) &&  !empty($_SESSION['error'])){
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
            }
        ?>
        <h1>Login Page</h1>
       
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" name="email" placeholder="enter your email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" placeholder="enter your password">
            </div>
            <button type="submit" name="login">Login</button>
            
        </form>
        <a href="register.php">Register</a>
        <a href="forgotpassword.php">Forgot password</a>
    </div>
<?php include "lib/footer.php"; ?>
<?php 
session_start();
include "loginprocess.php";
 ?>
<?php include "lib/header.php"; ?>
<body>
    <div class="container mt-5 d-flex align-items-center justify-content-center ">

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
       
        <main class="form-signin w-50">
        <a href="index.php"><button type="button" class="btn btn-primary">Home</button></a>
            <form action="login.php" method="POST">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="enter your email">
                <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Enter your Password">
                <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
            </form>
            <a href="register.php">Register</a>
            <a href="resetpassword.php">Reset password</a>
        </main>
       
    </div>
<?php include "lib/footer.php"; ?>
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
    
        <main class="form-signin w-50">
            <a href="index.php"><button type="button" class="btn btn-primary">Home</button></a>
            <form action="register.php" method="POST">
                <h1 class="h3 mb-3 fw-normal">Please sign Up</h1>

                <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="firstName" placeholder="enter your first Name">
                <label for="floatingInput">First Name</label>
                </div>
                <div class="form-floating">
                <input type="text" name="lastName" placeholder="Enter Last Name" class="form-control" id="floatingInput" name="lastName">
                <label for="floatingInput">Last Name</label>
                </div>
                <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="enter your email">
                <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Enter your Password">
                <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Register</button>
            </form>
            <a href="resetpassword.php">Reset password</a>|
            <a href="login.php">Login</a>
        </main>
        
    </div>
    <?php include "lib/footer.php"; ?>
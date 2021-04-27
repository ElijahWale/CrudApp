<?php
session_start();
// database connection
require_once "./core/db.php";


$errors="";
if(isset($_POST['submit'])){

    // validation for password
    if(empty($_POST['password'])){
        $errors .= "<br>your old password field is empty";
    }else{
        $password = $_POST['password'];
    }
    // validation for password
    if(empty($_POST['newPassword'])){
        $errors .= "<br>your new password field is empty";
    }else{
        $newPassword = $_POST['newPassword'];
    }

     // validation for email
     if(empty($_POST['email'])){
        $errors .= "<br>your email is empty ";
        
    }else{
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors .= "Enter a valid email address";   
        }
    }


    if($errors){
        echo $errors;
        // if there are  no errors in form
    }else{
        // checking the database if the email has been registered
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db_connect, $sql);

        if(!$result){
            $_SESSION['errors'] = 'Error running the query!';
           
        }
        //checking if the old password is in the database and also upfating the password 
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_assoc($result)){
                if(password_verify($password, $row['password'])){

                        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

                        $sql = "UPDATE users SET password= '$passwordHash' WHERE email = '$email'";
                        $query = mysqli_query($db_connect, $sql);

                        if(!$query){
                            $error_db = 'Error running the query!';
                            $_SESSION['errors'] = $error_db;
                            
                        }else{
                            $_SESSION["success"] = "Reset password successfully";
                            header('location: login.php');
                        }
                }else{
                    $errors = 'Wrong Email or password';
                    $_SESSION['errors'] = $errors;
                }
            
            }
                
        }else{
            $errors = 'User cannot be found';
            $_SESSION['errors'] = $errors;
        }
           
            
        
    }




}


?>





<?php include "lib/header.php"; ?>
<body>
    <div class="container">
    <?php
         // error message
         if(isset($_SESSION['errors'])){
            echo $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        // success message
        if(isset($_SESSION["success"])){
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
    ?>
    <h1>Reset Password</h1>
        <main class="form-signin w-50">
            <a href="index.php"><button type="button" class="btn btn-primary">Home</button></a>
            <form action="resetpassword.php" method="POST">
                

                <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="enter your email">
                <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Enter your Old Password">
                <label for="floatingPassword">Enter your Old Password</label>
                </div>
                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="newPassword" placeholder="Enter your New Password">
                <label for="floatingPassword">Enter your New Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Reset</button>
            </form>
            
        </main>
        
    </div>
    
    <?php include "lib/footer.php"; ?>
<?php
session_start();
// database connection
require_once "./core/db.php";
// user that is not logged in should not have to this page
if(!$_SESSION['user_id']){
    $_SESSION['errors'] = "User is not allowed to view this page";
    header('location: login.php');
}

$errors="";
if(isset($_POST['submit'])){

    // validation for password
    if(empty($_POST['password'])){
        $errors .= "<br>your password is empty";
    }else{
        $password = $_POST['password'];
    }
    
    // validation for email
     $email = $_POST['email'];

    if($errors){
        echo $errors;
    }else{


            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password= 'passwordHash' WHERE email = $email";
            $query = mysqli_query($db_connect, $sql);

            if(!$query){
                $error_db = 'Error running the query!';
                $_SESSION['error'] = $error_db;
                
            }else{
                $_SESSION['success'] = 'Reset password successfully';
                header('location: login.php');
            }
            
        
    }




}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
        <form action="" method="POST">
            <label>Email</label><br>
            <input 
            
                <?php
            if(isset($_SESSION['email'])){
                echo "value=" . $_SESSION['email'];
            }

            ?>
            type="text" name="email"><br>
            <label for="">Enter New Password</label><br>
            <input type="password" name="password" placeholder="enter your password"><br>
            <button type="submit" name="submit">Update password </button>
        </form>
    </div>
</body>
</html>
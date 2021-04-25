<?php
session_start();

// database connection
require_once "./core/db.php";

$errors="";
if(isset($_POST['submit'])){

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
    }else{
       // count users in the database
       $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($db_connect, $sql);
        if(!$query){
            $error_db = 'Error running the query!';
            $_SESSION['error'] = $error_db;
            
        }
        if($results = mysqli_num_rows($query) == 1){ 
            if($row = mysqli_fetch_assoc($query)){

                $_SESSION['email'] =  $row['email'];
                $_SESSION['user_id'] = $row['id'];

                $_SESSION['success'] = 'Reset your password here';
                header('location: resetpassword.php');
            }
            
        }else{
            $_SESSION['errors'] ="Your email has not been registered";
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
    ?>
    <h1>Forgot password</h1>
        <form action="forgotpassword.php" method="POST">
            <label for="">Email</label>
            <input type="email" name="email" placeholder="enter your email">
            <button type="submit" name="submit"> Reset </button>
        </form>
        <a href="login.php"> 
        Login
        </a>
        <a href="index.php"> 
        Register
        </a>
    </div>
</body>
</html>

<?php
// database connection
require_once "./core/db.php";

require_once "./core/functions.php";





    $errors= "";

    if(isset($_POST['login'])){
         // validation for email
        if(empty($_POST['email'])){
            $errors.= "your email is empty";
        }else{
            $email = sanitize($_POST['email']);
        }

        // validation for password
        if(empty($_POST['password'])){
            $errors.= "<br>your password is empty";
        }else{
            $password = sanitize($_POST['password']);
        }
        
        if($errors){
            //print error message
            $_SESSION['error'] = $errors; 

        }else{
        $email = mysqli_real_escape_string($db_connect, $email);
        $password = mysqli_real_escape_string($db_connect, $password);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db_connect, $sql);

        if(!$result){
            $_SESSION['error'] = 'Error running the query!';
           
        }
        
        if(mysqli_num_rows($result) == 1){
            while ($row = mysqli_fetch_assoc($result)) {
                if(password_verify($password, $row['password'])){
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['firstName'] = $row['first_name'];
                    $_SESSION['lastName'] = $row['last_name'];

                    $_SESSION['success'] = "User is logged In";
                    header('location: dashboard.php');
                }else{
                    $errors = 'Wrong Email or password';
                    $_SESSION['error'] = $errors;
                }
            }
        }else{
            $errors = 'User cannot be found';
            $_SESSION['error'] = $errors;
        }

        

    }
}
?>
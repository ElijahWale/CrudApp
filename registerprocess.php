<?php
// database connection
 require_once "./core/db.php";
 
 
 require_once "./core/functions.php";

    // collect data from form
$errors= "";

if(isset($_POST['register'])){

    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validation for first name
    if(empty($firstName)){
        $errors = "your first name is empty";
    } elseif (strlen($firstName) < 2) {
        $errors .= "<br> First Name cannot be less than 2";
        
    
    } elseif(!preg_match("/^[a-zA-Z]+$/", $firstName)){
        $errors .= "Name should not be Numbers";
    }else{
        $firstName = sanitize($firstName);
    }
    
      
    // Validation for lastName  
    if(empty($lastName)){
        $errors .= "<br>your last Name is empty";
       
    }elseif (strlen($lastName) < 2) {
            $errors .= "last Name cannot be less than 2";
        
    
    } elseif(!preg_match("/^[a-zA-Z]+$/", $lastName)){
        $errors .= "Name should not be Numbers";
    }else{
        $lastName = sanitize($lastName);
    }
    
    // Validation for email
    if(empty($email)){
        $errors .= "<br>your email is empty";
        
    }elseif(strlen($email) < 5){
        $errors .= "<br>Email must not be less than 5";
    } else{
        $email = sanitize(filter_var($email, FILTER_SANITIZE_EMAIL));
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors .= "Enter a valid email address";   
        }
    }
    
    
     // validation for password
     if(empty($password)){
        $errors .= "<br> Please enter a Password!";

    } elseif(!(strlen($password) > 6 && preg_match('/[A-Z]/',$_POST["password"]) && preg_match('/[0-9]/',$_POST["password"]))){
        $errors.= "Your password should be at least 6 characters long and inlcude one capital letter and one number!";
    }else{
        $password = filter_var($password, FILTER_SANITIZE_STRING); 
    }


    
    if($errors){
        $_SESSION['error'] = $errors;
    }else{
        // sanitizing the data before entering the database
        $firstName = mysqli_real_escape_string($db_connect, $firstName);
        $lastName = mysqli_real_escape_string($db_connect, $lastName);
        $email = mysqli_real_escape_string($db_connect, $email);
        $password = mysqli_real_escape_string($db_connect, $password);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // check if user email has been registered before
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($db_connect, $sql);
        if(!$query){
            $error_db = 'Error running the query!';
            $_SESSION['error'] = $error_db;
            
        }
        if($results = mysqli_num_rows($query) == 1){
            $error_db = 'That email is already registered. Do you want to log in?'; 
            $_SESSION['error'] = $error_db;
           
        }else{
             //Insert user details in the users table
            $sql = "INSERT INTO users (`first_name`,`last_name`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$passwordHash')";
            $insert_user_db = mysqli_query($db_connect, $sql);

            if(!$insert_user_db){
                $error_db = '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
                $_SESSION['error'] = $error_db; 
                
            }else{
                $success_msg = '<div class="alert alert-success">You have successfully registered</div>'; 
                $_SESSION['success'] = $success_msg;
                header('location: login.php');
            }
        }
        
        
        

       

    }


        

    
    


    








}


?>
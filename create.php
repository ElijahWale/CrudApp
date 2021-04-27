<?php
session_start();
// database connection
require_once "./core/db.php";

function sanitize($data) {
    $text = trim($data);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);

    return $text;
}

if(isset($_POST['submit'])){
    $errors = '';
    if(empty($_POST['course'])){
        $errors.= "your course field is empty";
    }else{
        $course = sanitize($_POST['course']);
    }


    if(empty($_POST['details'])){
        $errors.= "<br>course details is empty";
    }else{
        $details = sanitize($_POST['details']);
    }


    if($errors){
        echo $errors;
    }else{
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['firstName']; 
         //Insert course details in the courses table
         $sql = "INSERT INTO courses (`course_enrolled`,`details`, `date_added`, `user_id`, username) VALUES('$course', '$details', now(), $user_id, $username)";
         $insert_course_db = mysqli_query($db_connect, $sql);

         if(!$insert_course_db){
             $error_db = '<div class="alert alert-danger">There was an error inserting the course details in the database!</div>' . mysqli_error($db_connect); 
             echo $error_db; 
             
         }else{
             $success_msg = '<div class="alert alert-success">You have successfully created a new course</div>'; 
             $_SESSION['success'] = $success_msg;
             header('location: dashboard.php');
         }
    }
    
}

?>
<?php include "lib/header.php"; ?>
<body>
    <div class="container">

            <form action="create.php" method="POST">
                <div class="form-group">
                    <label for="">Course Enrolled</label><br>
                    <input type="text" name="course">
                </div>
                <div class="form-group">
                    <label for="">Course Details</label><br>
                    <textarea name="details" id="" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="submit">Create</button>
            </form>
    </div>

<?php include "lib/footer.php"; ?>
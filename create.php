<?php
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
    if(empty($_POST['title'])){
        $errors.= "your title is empty";
    }else{
        $title = sanitize($_POST['title']);
    }


    if(empty($_POST['details'])){
        $errors.= "<br>course details is empty";
    }else{
        $details = sanitize($_POST['details']);
    }


    if($errors){
        echo $errors;
    }else{
         //Insert course details in the courses table
         $sql = "INSERT INTO courses (`title`,`details`, `date_added`) VALUES ('$title', '$details', now())";
         $insert_course_db = mysqli_query($db_connect, $sql);

         if(!$insert_course_db){
             $error_db = '<div class="alert alert-danger">There was an error inserting the course details in the database!</div>'; 
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
                    <label for="">Title</label><br>
                    <input type="text" name="title">
                </div>
                <div class="form-group">
                    <label for="">Course Details</label><br>
                    <textarea name="details" id="" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="submit">Create</button>
            </form>
    </div>

<?php include "lib/footer.php"; ?>
<?php
// database connection
session_start();
require_once "./core/db.php";

function sanitize($data) {
    $text = trim($data);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);

    return $text;
}
$user_id = $_SESSION['user_id'];
// getting the id of a course
if(isset($_GET['id'])){
    $id = $_GET['id'];


    $sql = "SELECT * FROM courses WHERE id = $id AND user_id = $user_id";
    $select_course_db = mysqli_query($db_connect, $sql);

    if(!$select_course_db){
        $error_db = '<div class="alert alert-danger">There was an error reading the course details in the database!</div>'; 
        echo $error_db; 
        
    }else{
        while($row = mysqli_fetch_assoc($select_course_db)){
            $update_id = $row['id'];
            $course_enrolled = $row['course_enrolled'];
            $course_details = $row['details'];

        }
    }
}




// updating course
if(isset($_POST['update'])){
    $errors = '';
    if(empty($_POST['course'])){
        $errors.= "your course field is empty";
    }else{
       $course = sanitize($_POST['course']);
    }

    // validation for course details
    if(empty($_POST['details'])){
        $errors.= "<br>course details field is empty";
    }else{
        $details = sanitize($_POST['details']);
    }
    $course_id = $_POST['course_id'];

    
    if($errors){
        echo $errors;
    }else{
        $course = mysqli_real_escape_string($db_connect, $course);
        $details = mysqli_real_escape_string($db_connect, $details);

        $sql = "UPDATE courses SET course_enrolled= '$course', details= '$details', date_added = now() WHERE id = $course_id AND user_id = $user_id";
        $query = mysqli_query($db_connect, $sql);
        if(!$query){
            $error_db = 'Error running the query!';
            $_SESSION['errors'] = $error_db;
            
        }else{
            $_SESSION["success"] = "Course updated successfully";
            header('location: dashboard.php');
        }
    }

    
}

?>
<?php include "lib/header.php"; ?>
<body>
    <div class="container">
    <a href="dashboard.php"><button type="button" class="btn btn-primary">Go back</button></a>
    <h2>Edit Course</h2>
   
            <form action="update.php" method="POST">
                <div class="form-group">
                    <label for="">Title</label><br>
                    <input type="text" name="course" value="<?= $course_enrolled; ?>">
                </div>
                <div class="form-group">
                    <label for="">Course Details</label><br>
                    <textarea name="details" id="" cols="30" rows="10"><?= $course_details; ?></textarea>
                </div>
                <input type="hidden" value="<?= $update_id; ?>" name="course_id">
                <button type="submit" name="update">Update</button>
            </form>
    </div>

<?php include "lib/footer.php"; ?>
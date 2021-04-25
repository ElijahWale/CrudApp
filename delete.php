<?php
// database connection
require_once "./core/db.php";

if(isset($_GET['id'])){
    $course_id = $_GET['id'];
}

$sql = "DELETE FROM courses WHERE id = $course_id";
$delete_course_db = mysqli_query($db_connect, $sql);

    if(!$delete_course_db){
        $error_db = '<div class="alert alert-danger">There was an error deleting the course details in the database!</div>'; 
        $_SESSION["error"] = $error_db; 
        
    }else{

        $success_msg = '<div class="alert alert-success">You have successfully deleted a new course</div>'; 
        $_SESSION['success'] = $success_msg;
        header('location: dashboard.php');
    }


?>
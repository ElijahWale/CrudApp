<?php
// database connection
require_once "./core/db.php";

function sanitize($data) {
    $text = trim($data);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);

    return $text;
}
// getting the id of a course
if(isset($_GET['id'])){
    $course_id = $_GET['id'];
}


// updating course
if(isset($_POST['update'])){
    $errors = '';
    if(empty($_POST['title'])){
        $errors.= "your title is empty";
    }else{
        $title = sanitize($_POST['title']);
    }

    // validation for password
    if(empty($_POST['details'])){
        $errors.= "<br>course details is empty";
    }else{
        $details = sanitize($_POST['details']);
    }


    if($errors){
        echo $errors;
    }else{
         //update course details in the courses table
         $sql= "UPDATE courses SET title = '$title', details = '$details', date_added = now() WHERE id = {$course_id}";
         $update_course_db = mysqli_query($db_connect, $sql);

         if(!$update_course_db){
             $error_db = '<div class="alert alert-danger">There was an error updating the course details in the database!</div>'; 
             echo $error_db; 
             
         }else{
             $success_msg = '<div class="alert alert-success">You have successfully updated the course</div>'; 
             $_SESSION['success'] = $success_msg;
             header('location: dashboard.php');
         }
    }
    
}

?>
<?php include "lib/header.php"; ?>
<body>
    <div class="container">
    <h2>Edit Course</h2>
    <?php
        $sql = "SELECT * FROM courses WHERE id = $course_id";
        $select_course_db = mysqli_query($db_connect, $sql);

            if(!$select_course_db){
                $error_db = '<div class="alert alert-danger">There was an error reading the course details in the database!</div>'; 
                echo $error_db; 
                
            }else{
                while($row = mysqli_fetch_assoc($select_course_db)){
                    $id = $row['id'];
                    $course_title = $row['title'];
                    $course_details = $row['details'];

                }
            }

    ?>

            <form action="update.php" method="POST">
                <div class="form-group">
                    <label for="">Title</label><br>
                    <input type="text" name="title" value="<?= $course_title ?>">
                </div>
                <div class="form-group">
                    <label for="">Course Details</label><br>
                    <textarea name="details" id="" cols="30" rows="10"><?= $course_details ?></textarea>
                </div>
                <button type="submit" name="update">Update</button>
            </form>
    </div>

<?php include "lib/footer.php"; ?>
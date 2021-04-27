<?php
// database connection
session_start();
require_once "./core/db.php";

// if user is not logged in 
if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
    header("location: login.php");
}

?>

<?php include "lib/header.php"; ?>
<body>
    <div class="container">
        <?php
            if(isset($_SESSION['success']) &&  !empty($_SESSION['success'])){
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
        ?>

        <?php
            if(isset($_SESSION['error']) &&  !empty($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
        <h1> Welcome on Board <?=$_SESSION['email'] ?></h1>
        <h2 class="text-center">List of all Courses</h2>
        <a href="create.php"><button type="button" class="btn btn-primary">Add Course</button></a>
        <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
        <div class="table mt-4">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">Username</th>
                <th scope="col">Course Enrolled</th>
                <th scope="col">Course Details</th>
                <th scope="col">Date Enrolled</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM courses WHERE user_id = $user_id ";
                $select_all_courses = mysqli_query($db_connect, $sql);
                if(!$select_all_courses){
                    echo "Error running the query!";
                }
                $i = 1;
                if($num_rows = mysqli_num_rows($select_all_courses) > 0){
                     while($row = mysqli_fetch_assoc($select_all_courses)){
                    $id = $i++;
                    $course_enrolled = $row['course_enrolled'];
                    $course_details = $row['details'];
                    $username = $row['username'];
                    $course_date = $row['date_added'];

            ?>
                 
               
                <tr>
                <th scope="row"><?=$id; ?></th>
                <th><?=$username ?></th>
                <td><?=$course_enrolled; ?></td>
                <td><?=$course_details; ?></td>
                <td><?=$course_date; ?></td>    
                <td> <a href="update.php?id=<?= $row['id']; ?>"><button type="button" class="btn btn-success">Edit</button></a>|<a href="delete.php?id=<?= $row['id']; ?>"> <button type="button" class="btn btn-danger">Delete</button></a></td>
                </tr>
            <?php } }else{?>
                <div class="alert alert-danger">No records found in the database</div>
                <?php } ?>
            </tbody>
            </table>
        </div>
        
    </div>


<?php include "lib/footer.php"; ?>
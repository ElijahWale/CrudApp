<?php
// database connection
require_once "./core/db.php";

?>

<?php include "lib/header.php"; ?>
<body>
    <div class="container">
        <?php
            if(isset($_SESSION['success']) &&  !empty($_SESSION['success'])){
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
            }
        ?>

        <?php
            if(isset($_SESSION['error']) &&  !empty($_SESSION['error'])){
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
            }
        ?>
        <h2 class="text-center">List of all Courses</h2>
        <a href="create.php"><button type="button" class="btn btn-primary">Add Course</button></a>
        <div class="table mt-4">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Course Details</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM courses";
                $select_all_courses = mysqli_query($db_connect, $sql);
                if(!$select_all_courses){
                    echo "Error running the query!";
                }
                $i = 1; 
                while($row = mysqli_fetch_assoc($select_all_courses)){
                    $id = $i++;
                    $course_title = $row['title'];
                    $course_details = $row['details'];
                    $course_date = $row['date'];

            ?>
                <tr>
                <th scope="row"><?=$id ?></th>
                <td><?=$course_title ?></td>
                <td><?=$course_details ?></td>
                <td><?=$course_date?></td>    
                <td> <a href="update.php?id=<?= $row['id'] ?>"><button type="button" class="btn btn-success">Edit</button></a>|<a href="delete.php?id=<?= $row['id'] ?>"> <button type="button" class="btn btn-danger">Delete</button></a></td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>
        
    </div>


<?php include "lib/footer.php"; ?>
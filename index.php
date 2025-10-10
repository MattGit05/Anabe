<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center p-5 bg-dark text-white mb-3">CRUD APPLICATION USING PHP AND MYSQL</h1>
 
                  <div class="d-flex justify-content-end mb-3">
                     <button class="btn btn-danger" onclick="confirmLogout()">Logout</button>
                 </div>


                <?php
                // Display success message
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo htmlspecialchars($_GET['success']);
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    echo '</div>';
                }

                // Display error message
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo htmlspecialchars($_GET['error']);
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    echo '</div>';
                }
                ?>

                <div class="d-flex justify-content-between mb-3">
                    <h3 class="text-left">All Students</h3>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">Create</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'db_config/dbconn.php';
                                $sql = "SELECT * FROM students";
                                $result = mysqli_query($connection, $sql);

                                if(!$result){
                                    die("Query failed: " . mysqli_error($connection));
                                }

                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                    <td><?php echo $row['age']; ?></td>
                                    <td></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include 'component/modal.php'; ?>
    <script>
      function confirmLogout() {
        const confirmation = confirm("Are you sure you want to logout?");
          if (confirmation) {
        window.location.href = "logout.php";
           }
         }
      </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</html>

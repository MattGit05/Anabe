<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #212529;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .logout-btn {
            background-color: #dc3545;
            border: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
            color: #fff;
        }
    </style>
    
</head>
<body>

    <!-- ===== HEADER SECTION ===== -->
    <header>
        <h1>CRUD APPLICATION USING PHP AND MYSQL</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">

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
                        <thead class="table-dark">
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
                                    <td>
                                        <!-- You can add Edit/Delete buttons here later -->
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'component/modal.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  // ===== Show logout success message =====
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('logout') === 'success') {
    // Create alert element
    const alertBox = document.createElement('div');
    alertBox.className = 'alert alert-success text-center fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow';
    alertBox.style.zIndex = '1055';
    alertBox.textContent = 'You have logged out successfully. Redirecting...';

    // Add to body
    document.body.appendChild(alertBox);

    // Fade out after 3 seconds
    setTimeout(() => {
      alertBox.classList.remove('show');
      alertBox.classList.add('fade');
      setTimeout(() => alertBox.remove(), 500);
    }, 3000);

    // Redirect after 4 seconds (adjust if needed)
    setTimeout(() => {
      window.location.href = "login.php"; // 👈 change this to your actual login page
    }, 4000);
  }
</script>

</body>
</html>

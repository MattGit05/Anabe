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
  <title>User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  #toastContainer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    z-index: 9999;
  }

  .custom-toast {
    background-color: #28a745;
    color: #fff;
    padding: 15px 25px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    font-size: 16px;
    max-width: 90%;
    text-align: center;
    pointer-events: all;
    animation: fadeInOut 3s forwards;
  }

  @keyframes fadeInOut {
    0% { opacity: 0; transform: translateY(-20px); }
    10%, 90% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-20px); }
  }
  </style>
</head>
<body>

  <!-- ===== HEADER ===== -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center p-5 bg-dark text-white mb-3">USER MANAGEMENT</h1>

        <!-- ===== ACTION BUTTONS ===== -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
          <!-- Left: Add User -->
          <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add User</a>

          <!-- Right: Navigation and Logout -->
          <div class="d-flex gap-2">
            <a href="index.php" class="btn btn-secondary">Students</a>
            <button class="btn btn-danger" id="logoutBtn">Logout</button>
          </div>
        </div>

        <!-- ===== SUCCESS / ERROR MESSAGES ===== -->
        <?php
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo htmlspecialchars($_GET['success']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
        }

        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo htmlspecialchars($_GET['error']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
        }
        ?>

        <!-- ===== USERS TABLE ===== -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <h3>ALL  USERS</h2>
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                
              <?php
              include 'db_config/dbconn.php';
              $sql = "SELECT * FROM users";
              $result = mysqli_query($connection, $sql);

              if (!$result) {
                  die("Query failed: " . mysqli_error($connection));
              }

            
          while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>
        <td>'.$row['id'].'</td>
        <td>'.htmlspecialchars($row['fullname']).'</td>
        <td>'.htmlspecialchars($row['email']).'</td>
        <td>
            <button class="btn btn-sm btn-warning editBtn" 
                data-id="'.$row['id'].'" 
                data-fullname="'.htmlspecialchars($row['fullname']).'" 
                data-email="'.htmlspecialchars($row['email']).'">
                Edit
            </button>
            <a href="delete_user.php?id='.$row['id'].'" 
               class="btn btn-sm btn-danger" 
               onclick="return confirm(\'Are you sure you want to delete this user?\');">
               Delete
            </a>
        </td>
    </tr>';
}


              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== USER MODAL COMPONENT ===== -->
  <?php include 'component/user_modal.php'; ?>

  <!-- ===== TOAST CONTAINER ===== -->
  <div class="toast-container" id="toastContainer"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  document.getElementById("logoutBtn").addEventListener("click", function () {
    const toastContainer = document.getElementById("toastContainer");

    toastContainer.innerHTML = `
      <div id="logoutToast" class="toast show custom-toast" role="alert">
        <div class="toast-body">
          ✅ <span>You have logged out successfully. Redirecting...</span>
        </div>
      </div>
    `;

    const logoutToast = document.getElementById("logoutToast");
    const toast = new bootstrap.Toast(logoutToast, { delay: 2500 });
    toast.show();

    setTimeout(() => {
      window.location.href = "logout.php";
    }, 3000);
  });

  document.addEventListener("DOMContentLoaded", function() {
  const editButtons = document.querySelectorAll(".editBtn");

  editButtons.forEach(btn => {
    btn.addEventListener("click", function() {
      // Get data from button
      const id = this.getAttribute("data-id");
      const fullname = this.getAttribute("data-fullname");
      const email = this.getAttribute("data-email");

      // Set modal input values
      document.getElementById("editId").value = id;
      document.getElementById("editFullname").value = fullname;
      document.getElementById("editEmail").value = email;

      // Show the modal
      const modal = new bootstrap.Modal(document.getElementById("editUserModal"));
      modal.show();
    });
  });
});
  </script>

</body>
</html>

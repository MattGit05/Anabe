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

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center p-5 bg-dark text-white mb-3">CRUD APPLICATION USING PHP AND MYSQL</h1>

      <!-- ACTION BUTTONS -->
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">Create</a>

        <div class="d-flex gap-2">
          <a href="user.php" class="btn btn-info text-white">User</a>
          <button class="btn btn-danger" id="logoutBtn">Logout</button>
        </div>
      </div>

      <!-- SUCCESS / ERROR MESSAGES -->
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

      <!-- STUDENT TABLE -->
      <div class="table-responsive">
        <h3>ALL STUDENTS</h3>
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

            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
              <td><?= $row['age'] ?></td>
              <td>
                <!-- Edit Button -->
                <button 
                  class="btn btn-sm btn-warning me-1 edit-btn"
                  data-id="<?= $row['id'] ?>"
                  data-firstname="<?= htmlspecialchars($row['first_name']) ?>"
                  data-lastname="<?= htmlspecialchars($row['last_name']) ?>"
                  data-age="<?= $row['age'] ?>"
                  data-bs-toggle="modal"
                  data-bs-target="#studentModal"
                >
                  Edit
                </button>

                <!-- Delete Button -->
                <a href="delete_student.php?id=<?= urlencode($row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- MODAL COMPONENT -->
<?php include 'component/modal.php'; ?>

<!-- TOAST CONTAINER -->
<div class="toast-container" id="toastContainer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Logout Button Toast
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

</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const studentForm = document.getElementById('studentForm');
    const modalTitle = document.getElementById('studentModalLabel');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');
    const studentId = document.getElementById('studentId');
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const age = document.getElementById('age');

    // Handle Edit buttons
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const fname = button.getAttribute('data-firstname');
            const lname = button.getAttribute('data-lastname');
            const studentAge = button.getAttribute('data-age');

            // Prefill modal with existing data
            studentId.value = id;
            firstName.value = fname;
            lastName.value = lname;
            age.value = studentAge;

            // Change modal for Edit
            modalTitle.textContent = "Edit Student";
            studentForm.action = "crud/update_student.php"; // form posts to update script
            modalSubmitBtn.textContent = "Update";
        });
    });

    // Reset modal when adding new student
    const studentModal = document.getElementById('studentModal');
    studentModal.addEventListener('show.bs.modal', (event) => {
        if (!event.relatedTarget.classList.contains('edit-btn')) {
            modalTitle.textContent = "Add Student";
            studentForm.action = "crud/create_student.php"; // form posts to create script
            modalSubmitBtn.textContent = "Save";
            studentId.value = "";
            firstName.value = "";
            lastName.value = "";
            age.value = "";
        }
    });
});
</script>
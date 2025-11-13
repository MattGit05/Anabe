<!-- Bootstrap Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="studentForm" action="crud/create_student.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="studentModalLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="first_name" required>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="last_name" required>
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" min="1" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- #region -->
 <!-- Bootstrap Modal (Add/Edit Student) -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="studentForm" action="crud/create_student.php" method="POST">
        <input type="hidden" name="id" id="studentId"> <!-- Used for edit -->
        <div class="modal-header">
          <h5 class="modal-title" id="studentModalLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="first_name" required>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="last_name" required>
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" min="1" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

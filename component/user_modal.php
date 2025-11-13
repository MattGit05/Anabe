<!-- ===== ADD USER MODAL ===== -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="userModalLabel">Add New User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="process/add_user.php" method="POST">
        <div class="modal-body p-4">
          
          <div class="mb-3">
            <label for="fullname" class="form-label fw-semibold">Full Name</label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter full name" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
          </div>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="saveUser" class="btn btn-primary">Save User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ===== EDIT USER MODAL ===== -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="update_user.php" method="POST">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="editId">

          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" id="editFullname" name="fullname" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" required>
          </div>

          <div class="mb-3">
            <label class="form-label">New Password (optional)</label>
            <input type="password" class="form-control" id="editPassword" name="password">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'db_config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email already exists (except for current user)
    $checkEmail = $connection->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $checkEmail->bind_param("si", $email, $id);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        header("Location: user.php?error=Email already exists.");
        exit();
    }

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = $connection->prepare("UPDATE users SET fullname=?, email=?, password=? WHERE id=?");
        $query->bind_param("sssi", $fullname, $email, $hashedPassword, $id);
    } else {
        $query = $connection->prepare("UPDATE users SET fullname=?, email=? WHERE id=?");
        $query->bind_param("ssi", $fullname, $email, $id);
    }

    if ($query->execute()) {
        header("Location: user.php?success=User updated successfully!");
    } else {
        header("Location: user.php?error=Failed to update user.");
    }

    $query->close();
    $connection->close();
}
?>

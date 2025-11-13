<?php
include '../db_config/dbconn.php';

if (isset($_POST['saveUser'])) {
    // Sanitize input
    $fullname = trim(mysqli_real_escape_string($connection, $_POST['fullname']));
    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));
    $password = trim(mysqli_real_escape_string($connection, $_POST['password']));

    // === Validation ===
    if (empty($fullname) || empty($email) || empty($password)) {
        header("Location: ../user.php?error=All fields are required!");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../user.php?error=Invalid email format!");
        exit();
    }

    // === Check if email already exists ===
    $checkQuery = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $checkResult = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: ../user.php?error=Email already exists!");
        exit();
    }

    // === Hash password ===
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // === Insert into database ===
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashedPassword')";

    if (mysqli_query($connection, $sql)) {
        header("Location: ../user.php?success=New user added successfully!");
        exit();
    } else {
        header("Location: ../user.php?error=Error adding user: " . mysqli_error($connection));
        exit();
    }

} else {
    // If accessed directly without form submission
    header("Location: ../user.php?error=Invalid access method!");
    exit();
}
?>

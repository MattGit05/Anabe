
<?php
session_start();
include 'db_config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email or username exists
    $check = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' OR username='$username'");
    if(mysqli_num_rows($check) > 0){
        $error = "Username or Email already exists!";
    } else {
        $insert = mysqli_query($connection, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
        if($insert){
            // Redirect to login page with success message
            header("Location: login.php?signup=success");
            exit();
        } else {
            $error = "Error creating account!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card p-4 shadow" style="width: 400px;">
    <h3 class="mb-3 text-center">Sign Up</h3>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>
    <?php if(isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>
    <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>

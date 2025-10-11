<?php
session_start();
include 'db_config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card p-4 shadow" style="width: 400px;">
    <h3 class="mb-3 text-center">Login</h3>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
        <button type="submit" class="btn btn-success w-100">Login</button>
    </form>
    <?php if(isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>
    <p class="mt-3 text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
</div>
</body>
</html>

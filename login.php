<?php
session_start();
include 'db_config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['name']; // ✅ fixed column name
        header("Location: index.php");         // ✅ removed ?
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
<title>Login | Eventify</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        color: #fff;
        width: 380px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }
    .form-control {
        background: rgba(255,255,255,0.2);
        border: none;
        color: #fff;
    }
    .form-control:focus {
        background: rgba(255,255,255,0.25);
        box-shadow: none;
        color: #fff;
    }
    .btn-custom {
        background: #48e169ff;
        border: none;
        transition: 0.3s;
        font-weight: 600;
    }
    .btn-custom:hover {
        background: #6a11cb;
    }
    a {
        color: #fff;
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="card text-center">
    <h2 class="mb-3 fw-bold">Welcome Back</h2>
    <p class="text-light mb-4">Login to your Eventify account</p>
    <form method="POST">
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-custom w-100 py-2">Login</button>
    </form>
    <?php if(isset($error)) echo "<p class='text-warning mt-3'>$error</p>"; ?>
    <p class="mt-4 mb-0">Don't have an account? <a href="signup.php">Sign Up</a></p>
</div>
</body>
</html>

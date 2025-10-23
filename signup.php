<?php
include 'db_config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $error = "Email already exists!";
    } else {
        $insert = mysqli_query($connection, "INSERT INTO users (name, email, password) VALUES ('name', '$email', '$password')");
        if ($insert) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Something went wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up | Eventify</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
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
        width: 400px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        transition: 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control {
        background: rgba(255,255,255,0.2);
        border: none;
        color: #fff;
    }
    .form-control:focus {
        background: rgba(255,255,255,0.3);
        box-shadow: none;
    }
    .btn-custom {
        background: #3ae26fff;
        border: none;
        transition: 0.3s;
        font-weight: 600;
    }
    .btn-custom:hover {
        background: #2575fc;
    }
    a {
        color: #fff;
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="card text-center">
    <h2 class="mb-3 fw-bold">Create Account</h2>
    <p class="text-light mb-4">Join Eventify and start planning smarter</p>
    <form method="POST">
        <div class="mb-3">
            <input type="text" name="username" placeholder="Username" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-custom w-100 py-2">Sign Up</button>
    </form>
    <?php if(isset($error)) echo "<p class='text-warning mt-3'>$error</p>"; ?>
    <p class="mt-4 mb-0">Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>

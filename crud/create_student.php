<?php
include '../db_config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $age = intval($_POST['age']);

    // Validate input
    if (empty($first_name) || empty($last_name) || $age <= 0) {
        header('Location: ../index.php?error=' . urlencode('Please fill in all fields with valid data'));
        exit;
    }

    // Prepare and execute insert query
    $sql = "INSERT INTO students (first_name, last_name, age) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $first_name, $last_name, $age);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($connection);
            header('Location: ../index.php?success=' . urlencode('Student created successfully!'));
            exit;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($connection);
            header('Location: ../index.php?error=' . urlencode('Error creating student: ' . mysqli_error($connection)));
            exit;
        }
    } else {
        mysqli_close($connection);
        header('Location: ../index.php?error=' . urlencode('Error preparing statement: ' . mysqli_error($connection)));
        exit;
    }
} else {
    header('Location: ../index.php?error=' . urlencode('Invalid request method'));
    exit;
}

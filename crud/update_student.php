<?php
include '../db_config/dbconn.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']); // hidden input from modal
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $age = intval($_POST['age']);

    // Optional: Check if any data actually changed
    $checkSql = "SELECT first_name, last_name, age FROM students WHERE id=?";
    $stmt = $connection->prepare($checkSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($oldFirst, $oldLast, $oldAge);
    $stmt->fetch();
    $stmt->close();

    if ($first_name === $oldFirst && $last_name === $oldLast && $age === $oldAge) {
        header("Location: ../index.php?error=You didn't make any changes");
        exit();
    }

    // Update student info
    $sql = "UPDATE students SET first_name=?, last_name=?, age=? WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssii", $first_name, $last_name, $age, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=Student updated successfully");
    } else {
        header("Location: ../index.php?error=Failed to update student");
    }

    $stmt->close();
    $connection->close();
}
?>

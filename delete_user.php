<?php
include 'db_config/dbconn.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: user.php?success=Student deleted successfully!");
        exit();
    } else {
        header("Location: user.php?error=No student found with that ID.");
        exit();
    }

    $stmt->close();
} else {
    header("Location: user.php?error=Invalid or missing student ID.");
    exit();
}

$connection->close();
?>

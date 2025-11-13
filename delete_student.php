<?php
include 'db_config/dbconn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM students WHERE id = $id";
    if (mysqli_query($connection, $sql)) {
        header("Location: index.php?success=Student deleted successfully");
    } else {
        header("Location: index.php?error=Failed to delete student");
    }
} else {
    header("Location: index.php?error=Invalid request");
}
exit();
?>

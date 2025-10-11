<?php
session_start();
session_unset();
session_destroy();

// Redirect back to login page with success message
header("Location: index.php?logout=success");
exit();
?>

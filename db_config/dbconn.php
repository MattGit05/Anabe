<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_crud"; // make sure this exists in phpMyAdmin

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

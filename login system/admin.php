<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");  // Redirect to login if not logged in
    exit();
}

require_once 'db_connect.php';  // Include database connection

// Fetch all users (students and tutors)
$sql = "SELECT * FROM loginsystem";
$users_result = $conn->query($sql);

?>

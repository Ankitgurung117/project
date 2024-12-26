<?php
// Start the session
session_start();

include "config.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get email and password from form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        $error = "Both fields are required.";
    } else {
        // Sanitize email to prevent SQL injection
        $email = $conn->real_escape_string($email);

        // Query to check the user
        $query = "SELECT `email` FROM loginsystem WHERE email = '$email'";
        $result = $conn->query($query);

        // Check if the user exists
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];

                // Redirect to the dashboard
                header("Location: home.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }
    }
}

$conn->close();
?>
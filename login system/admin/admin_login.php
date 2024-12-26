
<?php
// Start session
session_start();

// Check if the admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    header('Location: admin_dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
   include "config.php";

    // Query to get the admin user by email
    $sql = "SELECT `email` FROM admin WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variable for successful login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email; // Store the email in the session

            // Redirect to the dashboard
            header('Location: admin_dashboard.php');
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No user found with that email.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_log.css">
</head>
<body>
<div class="login-container">
    <h2>Admin Login</h2>
    
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    
    <form action="admin_dashboard.php" method="POST">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        
        <div class="loginbtn">
        <button type="submit" name="submit">Login</button>
        </div>
        </div>
    </form>
</body>
</html>
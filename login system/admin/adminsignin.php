<?php

include "config.php";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

   // Sanitize user input
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Check if the email already exists
    $sql = "SELECT `email`, `username` FROM `admin` WHERE email = '$email' OR username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If the email or full name already exists
        echo "Error: The full name or email already exists.";
    } else {
        // Insert new user into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    
    $sql = "INSERT INTO admin (username, email, password)
                VALUES ('$username', '$email', '$hashedPassword')";

     
if ($conn->query($sql) === TRUE) {
        // Redirect to the login page
        header('Location: admin_login.php');
        exit(); // Make sure to call exit to stop further script execution
    }
 else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }
}
$conn->close();      
?>     
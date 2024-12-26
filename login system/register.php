<?php

include "config.php";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // Sanitize user input
    $fullName = $conn->real_escape_string($fullName);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);
    $city = $conn->real_escape_string($city);
    $gender = $conn->real_escape_string($gender);
    $phone = $conn->real_escape_string($phone);


    // Check if the email already exists
    $sql = "SELECT `email`, `fullName` FROM `loginsystem` WHERE email = '$email' OR fullName = '$fullName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If the email or full name already exists
        echo "Error: The full name or email already exists.";
    } else {
        // Insert new user into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

        $sql = "INSERT INTO loginsystem (fullName, email, password, city, gender, phone)
                VALUES ('$fullName', '$email', '$hashedPassword', '$city', '$gender', '$phone')";

        if ($conn->query($sql) === TRUE) {

            // redirect to login page
            header('Location: login.html');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>



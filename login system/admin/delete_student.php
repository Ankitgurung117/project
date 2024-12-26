<?php
// Include database configuration
include "config.php";

// Check if the ID is set in the POST request
if (isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = intval($_POST['id']); // Convert to integer to ensure it's a valid number

    // SQL query to delete the student with the given ID
    $sql = "DELETE FROM loginsystem WHERE id = $id";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo"account deleted successfully: ";
        // Redirect back to the admin dashboard or student management section
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Display an error message
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect back if no ID is provided
    header("Location: admin_dashboard.php");
    exit();
}

// Close the database connection
$conn->close();
?>

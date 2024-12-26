<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];

    $sql = "INSERT INTO tutor (name, subject, email, phone, bio, status) VALUES (:name, :subject, :email, :phone, :bio, 'pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'subject' => $subject, 'email' => $email, 'phone' => $phone, 'bio' => $bio]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tutor</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="form-container">
        <h1>Add New Tutor</h1>
        <form action="add_tutor.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone"><br>

            <label for="bio">Bio:</label>
            <textarea name="bio" required></textarea><br>

            <button type="submit">Add Tutor</button>
        </form>
    </div>
</body>
</html>
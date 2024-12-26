<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .d-flex {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h4 {
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar ul li a:hover {
            background-color: #495057;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }
        h4 {
            margin-bottom: 15px;
        }
        form {
            max-width: 500px;
            margin-bottom: 30px;
        }
        form .form-group {
            margin-bottom: 15px;
        }
        form .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        form .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4>Admin Dashboard</h4>
            <hr>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#addTutor">Add Tutor</a></li>
                <li><a href="#manageTutors">Manage Tutors</a></li>
                <li><a href="#manageStudents">Manage Students</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div>
                <h2 style='display:inline;'>Welcome, Admin</h2>
                <form action='admin_logout.php' method='POST' style='display:inline;'>
                                    
                      <button type='submit' onclick="window.location.href='admin_logout.php';" class='btn btn-danger'>Logout</button>
                      </form>

                <hr>
            </div>


            <!-- Add Tutor Section -->
            <div id="addTutor">
                <h4>Add Tutor</h4>
                <form action="add_tutor.php" method="POST">
                    <div class="form-group">
                        <label for="tutorName">Name</label>
                        <input type="text" id="tutorName" name="name" placeholder="Enter tutor name" required>
                    </div>
                    <div class="form-group">
                        <label for="tutorEmail">Email</label>
                        <input type="email" id="tutorEmail" name="email" placeholder="Enter tutor email" required>
                    </div>
                    <div class="form-group">
                        <label for="tutorSubject">Subject</label>
                        <input type="text" id="tutorSubject" name="subject" placeholder="Enter subject" required>
                    </div>
                    <div class="form-group">
                        <label for="tutorCity">City</label>
                        <input type="text" id="tutorCity" name="city" placeholder="Enter city" required>
                    </div>
                    <div class="form-group">
                        <label for="tutorGender">Gender</label>
                        <input type="text" id="tutorGender" name="gender" placeholder="Enter gender" required>
                    </div>
                    <div class="form-group">
                        <label for="tutorPhone">Phone</label>
                        <input type="text" id="tutorPhone" name="phone" placeholder="Enter phone" required>
                    </div>
                    <button type="submit">Add Tutor</button>
                </form>
            </div>

            <!-- Manage Tutors Section -->
            <div id="manageTutors">
                <h4>Manage Tutors</h4>
                <table>
                    <thead>
                        <tr>
                        <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>City</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to the database
                        include "config.php";
                        $sql = "SELECT * FROM tutor";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['subject'] . "</td>
                                    <td>" . $row['city'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                    <td>" . $row['phone'] . "</td>
                                    <td>
                                        <button class='btn btn-warning'>Edit</button>
                                        <button class='btn btn-danger'>Delete</button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No tutors found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Manage Students Section -->
            <div id="manageStudents">
                <h4>Manage Students</h4>
                <table>
                    <thead>
                        <tr>
                        <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                          <?php
                        // Connect to the database
                        include "config.php";
                        $sql = "SELECT * FROM loginsystem";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['fullName'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['city'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                    <td>" . $row['phone'] . "</td>
                                    <td>
                                        <form action='delete_student.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <button type='submit' class='btn btn-danger'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No students found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
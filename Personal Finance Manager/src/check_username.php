<?php
session_start();
include('config.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);

    // Check if username is empty
    if (empty($username)) {
        echo 'invalid'; // Invalid username
        exit;
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Return 'available' if the username doesn't exist, else return 'taken'
    echo $count === 0 ? 'available' : 'taken';
} else {
    echo 'invalid'; // Invalid request
}
?>

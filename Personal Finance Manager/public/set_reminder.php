<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Get user input
$title = $_POST['title'];
$description = $_POST['description'];
$reminder_date = $_POST['reminder_date'];
$user_id = $_SESSION['user_id'];

// Validate user input
if (empty($title) || empty($reminder_date)) {
    // Handle errors (e.g., redirect back with an error message)
    die('Title and reminder date are required.');
}

// Insert reminder into database
$sql = "INSERT INTO reminders (user_id, title, description, reminder_date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $title, $description, $reminder_date);
$stmt->execute();

// Redirect to reminders page or show a success message
header('Location: reminders.php');
exit();
?>

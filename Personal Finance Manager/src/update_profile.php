<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit();
}

// Include database connection
include('config.php');

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Get the updated profile details from the form
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Validate the inputs (you can add more validation as needed)
if (empty($username) || empty($email)) {
    // Redirect back to the profile page with an error message
    header('Location: ../public/all_settings.php?status=error');
    exit();
}

// Prepare SQL query to update user details
$sql = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $username, $email, $user_id);

// Execute the query and check for errors
if ($stmt->execute()) {
    // Redirect back to the profile page with a success message
    header('Location: ../public/all_settings.php?status=success');
} else {
    // Redirect back to the profile page with an error message
    header('Location: ../public/all_settings.php?status=error');
}

$stmt->close();
$conn->close();
?>

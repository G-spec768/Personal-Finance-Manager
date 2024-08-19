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

// Initialize settings variables
$notifications = isset($_POST['notifications']) ? implode(',', $_POST['notifications']) : '';
$theme = isset($_POST['theme']) ? $_POST['theme'] : 'light';
$language = isset($_POST['language']) ? $_POST['language'] : 'en';
$currency = isset($_POST['currency']) ? $_POST['currency'] : 'usd';

// Prepare SQL query to update user settings
$sql = "UPDATE user_settings SET notifications = ?, theme = ?, language = ?, currency = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $notifications, $theme, $language, $currency, $user_id);

// Execute the query and check for errors
if ($stmt->execute()) {
    // Redirect back to the settings page with a success message
    header('Location: ../public/settings.php?status=success');
} else {
    // Redirect back to the settings page with an error message
    header('Location: ../public/settings.php?status=error');
}

$stmt->close();
$conn->close();
?>

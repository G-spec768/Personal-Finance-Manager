<?php
session_start();

// Include database connection
include('config.php');

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Process settings form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle notification preferences
    $notifications = isset($_POST['notifications']) ? implode(',', $_POST['notifications']) : '';
    
    // Handle theme selection
    $theme = isset($_POST['theme']) ? $_POST['theme'] : 'light';
    
    // Handle language and currency
    $language = isset($_POST['language']) ? $_POST['language'] : 'en';
    $currency = isset($_POST['currency']) ? $_POST['currency'] : 'usd';

    // Update user settings in the database
    $sql = "UPDATE user_settings SET notifications = ?, theme = ?, language = ?, currency = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $notifications, $theme, $language, $currency, $user_id);

    if ($stmt->execute()) {
        // Success: Redirect back to settings page with a success status
        header('Location: ../public/all_settings.php?status=success');
        exit();
    } else {
        // Error: Redirect back to settings page with an error status
        header('Location: ../public/settings.php?status=error');
        exit();
    }
} else {
    // If the request method is not POST, redirect back to the settings page
    header('Location: ../public/settings.php');
    exit();
}

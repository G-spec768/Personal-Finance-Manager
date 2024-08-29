<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        // Destroy the session to log out the user
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session

        // Redirect to the index page or login page
        header('Location: index.php'); // Adjust the redirect URL as needed
        exit();
    } else {
        // Redirect back to the confirmation page if no confirmation is received
        header('Location: logout.php'); // Redirect back to the same page to show confirmation
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Logout</title>
    <link rel="stylesheet" href="logout_confirm.css"> <!-- Add your stylesheet here -->
</head>
<body>
    <?php include('../templates/user_header.php'); ?>

    <div class="logout-confirm-container">
        <h1>Confirm Logout</h1>
        <p>Are you sure you want to log out?</p>
        <form action="logout.php" method="post">
            <input type="submit" name="confirm" value="Yes, Logout">
            <a href="index.php" class="cancel-button">Cancel</a> <!-- Redirect to index or a different page -->
        </form>
    </div>

    <?php include('../templates/footer.php'); ?>
</body>
</html>

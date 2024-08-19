<?php
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
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
            <a href="logout_confirm.php" class="cancel-button">Cancel</a>
        </form>
    </div>

    <?php include('../templates/footer.php'); ?>
</body>
</html>

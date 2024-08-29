<?php
session_start();
include('../src/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('admin_auth.php'); // Process login credentials
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../public/combined_styles.css"> <!-- Link to combined styles -->
</head>
<body>
    <?php include('../templates/admin_header.php'); ?> <!-- Include header -->

    <div class="admin-container">
        <h1>Admin Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="admin_login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <?php include('../templates/admin_footer.php'); ?> <!-- Include footer -->
</body>
</html>

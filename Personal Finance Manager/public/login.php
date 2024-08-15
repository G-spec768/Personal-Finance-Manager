<!-- public/login.php -->

<?php
// Assuming you have checked the user's credentials and started a session
session_start();
$_SESSION['user_id'] = $user_id; // Set user ID session variable

// Redirect to dashboard
header('Location: dashboard.php');
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>

<?php include('../templates/header.php'); ?>

<h2>Login</h2>
<form action="../src/authenticate_user.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

<?php include('../templates/footer.php'); ?>

</body>
</html>

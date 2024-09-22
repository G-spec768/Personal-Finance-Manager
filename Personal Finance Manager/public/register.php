<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager Register</title>
    <link rel="stylesheet" href="../public/register_login.css">
</head>
<body>
<?php include('../templates/header.php'); ?>
<div class="container">
    <h2>Register</h2>
    <form action="../src/register_user.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Register"> 
    </form>
</div>
<script src="register.js"></script> 
<?php include('../templates/footer.php'); ?>
</body>
</html>

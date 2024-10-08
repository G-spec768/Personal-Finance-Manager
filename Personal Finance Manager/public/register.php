<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager Register</title>
    <link rel="stylesheet" href="register_login.css">
</head>
<body>
<?php include('../templates/header.php'); ?>
<div class="container">

<h2>Register</h2>
<form action="../src/register_user.php" method="post">
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" required><br>

    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name" required><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone" required><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

     <input type="submit" value="Register"> 
 </form>
</div>

<script src="register.js"></script> 
<?php include('../templates/footer.php'); ?>
</body>
</html>

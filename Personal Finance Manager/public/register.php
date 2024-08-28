<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager Register</title>
</head>
<body>
<?php include('../templates/header.php'); ?>
<h2>Register</h2>
<form action="../src/register_user.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Register"> 
</form>

<script src="register.js"></script> 

<?php include('../templates/footer.php'); ?>
 
</body>
</html>

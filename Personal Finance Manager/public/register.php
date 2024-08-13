<!-- // public/register.php -->
<?php include('../templates/header.php'); ?>

<h2>Register</h2>
<form action="../src/register_user.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Register">
</form>

<?php include('../templates/footer.php'); ?>

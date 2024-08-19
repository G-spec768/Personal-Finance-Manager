<?php include('../templates/header.php'); ?>

<h2>Register</h2>
<form action="../src/register_user.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <!-- Terms and Conditions Checkbox -->
    <input type="checkbox" id="terms" name="terms">
    <label for="terms">I agree to the Terms and Conditions</label><br><br>

    <input type="submit" value="Register" disabled> <!-- Initially disabled -->
</form>

<script src="register.js"></script> <!-- Link to your JavaScript file -->

<?php include('../templates/footer.php'); ?>

<?php
session_start();

if (isset($_POST['confirm'])) {
    // Destroy the session to log out the user
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the index page
    header('Location: index.php');
    exit();
} else {
    // Redirect back to the confirmation page if no confirmation is received
    header('Location: logout_confirm.php');
    exit();
}
?>

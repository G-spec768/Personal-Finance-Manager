<!-- templates/header.php -->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/dashboard.css"> <!-- Point to the correct CSS file -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="budget.php">Manage Budget</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>

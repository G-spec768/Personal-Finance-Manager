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
    <link rel="stylesheet" href="../public/user_header.css"> <!-- Point to the correct CSS file -->
    <title>User Dashboard</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="budget.php">Manage Budget</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="savings_goals.php">Savings Goals</a></li>
                <li><a href="budget_overview.php">Budget Overview</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="notifications.php">Notifications</a></li>
                <li><a href="reminders.php">Reminders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
   <main>
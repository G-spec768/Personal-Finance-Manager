<?php
session_start();

// Redirect to login page if the user is not logged in
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
    <link rel="stylesheet" href="dashboard.css">
    <title>Personal Finance Management Dashboard</title>
</head>
<body>
<?php include('../templates/user_header.php'); ?>
<div class="dashboard-container">
    <h1>Welcome to Your Dashboard</h1>
    <p>Manage your finances by entering your income, expenses, and budget.</p>

    <form id="finance-form">
        <label for="income">Income:</label>
        <input type="number" id="income" name="income" placeholder="Enter your income" required>

        <label for="expenses">Expenses:</label>
        <input type="number" id="expenses" name="expenses" placeholder="Enter your expenses" required>

        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget" placeholder="Enter your budget" required>

        <input type="submit" value="Update Chart">
    </form>

    <div class="chart-container">
        <canvas id="financeChart"></canvas>
    </div>
</div>

<?php include('../templates/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="dashboard.js"></script>

</body>
</html>

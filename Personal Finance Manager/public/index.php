

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Personal Finance Management System</title>
</head>
<body>
<?php include('../templates/header.php'); ?>

<div class="container">
    <h1>Welcome to Your Finance Dashboard</h1>
    <p>Track and manage your finances with ease. See how you're doing at a glance.</p>

    <section class="charts">
        <div class="chart-wrapper">
            <h3>Expense Breakdown</h3>
            <canvas id="expenseChart"></canvas>
        </div>

        <div class="chart-wrapper">
            <h3>Income vs. Expenses</h3>
            <canvas id="incomeExpenseChart"></canvas>
        </div>

        <div class="chart-wrapper">
            <h3>Budget Utilization</h3>
            <canvas id="budgetChart"></canvas>
        </div>
    </section>


    <section class="cta">
        <h2>Take Control of Your Finances</h2>
        <p><a href="register.php">Register</a> or <a href="login.php">login</a> to start now!</p>
    </section>
</div>

<?php include('../templates/footer.php'); ?>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="index.js"></script>

</body>
</html>

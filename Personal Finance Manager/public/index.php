<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Personal Finance Management System</title>
</head>
<body>
<?php include('../templates/header.php'); ?>

<div class="hero">
    <div class="hero-content">
        <h1>Welcome to Your Finance Dashboard</h1>
        <p>Effortlessly track and manage your finances with our intuitive tools. Get insights into your spending habits and stay on top of your financial goals.</p>
        <a href="register.php" class="btn-primary">Get Started</a>
    </div>
</div>

<div class="container">
    <section class="charts">
        <div class="chart-wrapper">
            <h3>Expense Breakdown</h3>
            <canvas id="expenseChart"></canvas>
        </div>

        <div class="chart-wrapper">
            <h3>Income vs. Expenses</h3>
            <canvas id="incomeExpenseChart"></canvas>
        </div>
    </section>

    <section class="cta">
        <h2>Ready to Take Control?</h2>
        <p>Join us today and gain full control over your finances. <a href="login.php" class="btn-secondary">Login</a> or <a href="register.php" class="btn-secondary">Register</a>.</p>
    </section>
</div>

<?php include('../templates/footer.php'); ?>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="index.js"></script>

</body>
</html>

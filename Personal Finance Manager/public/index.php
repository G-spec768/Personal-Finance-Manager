<?php include('../templates/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Personal Finance Management System</title>
</head>
<body>

<div class="container">
    <h1>Welcome to Your Finance Dashboard</h1>
    <p>Track and manage your finances with ease. See how you're doing at a glance.</p>

    <!-- Charts Section -->
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

    <!-- Call to Action Section -->
    <section class="cta">
        <h2>Take Control of Your Finances</h2>
        <p><a href="register.php">Register</a> or <a href="login.php">login</a> to start now!</p>
    </section>
</div>

<?php include('../templates/footer.php'); ?>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample data for charts
    var expenseData = [300, 500, 200, 400];
    var incomeData = [1500];
    var budgetData = [1200];

    // Expense Breakdown Pie Chart
    var ctxExpense = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctxExpense, {
        type: 'pie',
        data: {
            labels: ['Food', 'Rent', 'Utilities', 'Entertainment'],
            datasets: [{
                data: expenseData,
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Income vs. Expenses Bar Chart
    var ctxIncomeExpense = document.getElementById('incomeExpenseChart').getContext('2d');
    new Chart(ctxIncomeExpense, {
        type: 'bar',
        data: {
            labels: ['Income', 'Expenses'],
            datasets: [{
                label: 'Amount',
                data: [incomeData[0], expenseData.reduce((a, b) => a + b, 0)],
                backgroundColor: ['#36a2eb', '#ff6384']
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

    // Budget Utilization Line Chart
    var ctxBudget = document.getElementById('budgetChart').getContext('2d');
    new Chart(ctxBudget, {
        type: 'line',
        data: {
            labels: ['Budget', 'Expenses'],
            datasets: [{
                label: 'Amount',
                data: [budgetData[0], expenseData.reduce((a, b) => a + b, 0)],
                borderColor: '#ffce56',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>

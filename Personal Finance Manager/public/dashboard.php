<!-- public/dashboard.php -->
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
    <title>Dashboard</title>
    
</head>
<body>
<?php include('../templates/header.php'); ?>
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
<!-- Add this to the end of your dashboard.php just before the closing body tag -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.getElementById('finance-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get the values from the form
    var income = parseFloat(document.getElementById('income').value);
    var expenses = parseFloat(document.getElementById('expenses').value);
    var budget = parseFloat(document.getElementById('budget').value);

    // Create the chart data
    var data = {
        labels: ['Income', 'Expenses', 'Budget'],
        datasets: [{
            label: 'Financial Overview',
            data: [income, expenses, budget],
            backgroundColor: [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Create the chart
    var ctx = document.getElementById('financeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

</body>
</html>





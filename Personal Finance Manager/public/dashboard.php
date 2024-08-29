<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch current balance
$balance_query = "SELECT SUM(amount) AS balance FROM transactions WHERE user_id = ?";
$stmt = $conn->prepare($balance_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$balance_result = $stmt->get_result()->fetch_assoc();
$current_balance = $balance_result['balance'] ?? 0;

// Fetch yesterday's transactions
$yesterday_query = "SELECT description, amount FROM transactions WHERE user_id = ? AND DATE(created_at) = CURDATE() - INTERVAL 1 DAY";
$stmt = $conn->prepare($yesterday_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch upcoming bills
$bills_query = "SELECT description, due_date FROM transactions WHERE user_id = ? AND type = 'bill' AND due_date > CURDATE() ORDER BY due_date ASC LIMIT 1";
$stmt = $conn->prepare($bills_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$upcoming_bill = $stmt->get_result()->fetch_assoc();

// Fetch budget alerts
$budget_query = "SELECT category, amount, spent FROM budgets WHERE user_id = ?";
$stmt = $conn->prepare($budget_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$budgets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch savings goal progress
$goal_query = "SELECT goal_name, goal_amount, saved_amount FROM goals WHERE user_id = ?";
$stmt = $conn->prepare($goal_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$goals = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$conn->close();
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
        <p>Manage your finances by keeping track of your income, expenses, and goals.</p>

        <!-- Morning Check-In Section -->
        <section class="morning-check-in">
            <h2>Morning Check-In</h2>
            <div class="balance-summary">
                <p>Current Balance: <span class="balance-amount">$<?php echo number_format($current_balance, 2); ?></span></p>
                <p>Yesterday's Transactions:</p>
                <ul>
                    <?php if (!empty($transactions)): ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <li><?php echo htmlspecialchars($transaction['description']); ?> - $<?php echo number_format($transaction['amount'], 2); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No transactions recorded yesterday.</li>
                    <?php endif; ?>
                </ul>
                <p>Upcoming Bill: <?php echo $upcoming_bill ? htmlspecialchars($upcoming_bill['description']) . " due on " . date("F j, Y", strtotime($upcoming_bill['due_date'])) : "No upcoming bills."; ?></p>
            </div>
        </section>

        <!-- Quick Action Section -->
        <section class="quick-action">
            <h2>Quick Actions</h2>
            <div class="budget-alert">
                <?php foreach ($budgets as $budget): ?>
                    <?php 
                        $spent_percentage = ($budget['spent'] / $budget['amount']) * 100; 
                        if ($spent_percentage >= 80) {
                            echo "<p>Alert: You are nearing your budget limit for {$budget['category']}!</p>";
                        }
                    ?>
                <?php endforeach; ?>
                <button class="adjust-budget-btn" onclick="adjustBudget()">Adjust Spending Plan</button>
            </div>
        </section>

        <!-- Goal Progress Review Section -->
        <section class="goal-progress">
            <h2>Goal Progress</h2>
            <?php foreach ($goals as $goal): ?>
                <?php 
                    $progress_percentage = ($goal['saved_amount'] / $goal['goal_amount']) * 100; 
                ?>
                <div class="goal-card">
                    <p>Savings Goal: <?php echo htmlspecialchars($goal['goal_name']); ?></p>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: <?php echo $progress_percentage; ?>%;">
                            <?php echo round($progress_percentage); ?>% Complete
                        </div>
                    </div>
                    <button class="allocate-funds-btn">Allocate Funds</button>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- End of Month Overview Section -->
        <section class="end-of-month">
            <h2>End of Month Overview</h2>
            <div class="summary-chart">
                <canvas id="spendingChart"></canvas>
            </div>
            <button class="adjust-budget-btn" onclick="setNewGoals()">Set New Goals</button>
        </section>
    </div>

    <?php include('../templates/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>

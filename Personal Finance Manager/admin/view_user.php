<!-- admin/view_user.php -->
<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Include database connection
include('../config/db_connect.php');

// Fetch user details
$user_id = $_GET['id'];
$sql = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch user's budgets
$sql = "SELECT category, amount FROM budgets WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$budget_result = $stmt->get_result();
$budgets = $budget_result->fetch_all(MYSQLI_ASSOC);

// Fetch user's transactions
$sql = "SELECT transaction_date, description, amount, type FROM transactions WHERE user_id = ? ORDER BY transaction_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$transaction_result = $stmt->get_result();
$transactions = $transaction_result->fetch_all(MYSQLI_ASSOC);
?>

<?php include('../templates/admin_header.php'); ?>

<div class="admin-container">
    <h1>User Details</h1>
    <h2><?php echo htmlspecialchars($user['username']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</h2>
    <p>Registered On: <?php echo htmlspecialchars($user['created_at']); ?></p>

    <h3>Budgets</h3>
    <table id="budgets-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($budgets as $budget): ?>
                <tr>
                    <td><?php echo htmlspecialchars($budget['category']); ?></td>
                    <td><?php echo htmlspecialchars($budget['amount']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Transactions</h3>
    <table id="transactions-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction['transaction_date']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['amount']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['type']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../templates/admin_footer.php'); ?>

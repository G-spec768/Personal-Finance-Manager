<!-- public/transactions.php -->
<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../config/db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_date = $_POST['transaction_date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $user_id = $_SESSION['user_id'];

    // Insert the transaction details into the database
    $sql = "INSERT INTO transactions (user_id, transaction_date, description, amount, type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issds", $user_id, $transaction_date, $description, $amount, $type);
    $stmt->execute();
}

// Fetch the transactions from the database
$sql = "SELECT transaction_date, description, amount, type FROM transactions WHERE user_id = ? ORDER BY transaction_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
</head>
<body>
<?php include('../templates/header.php'); ?>

<div class="transactions-container">
    <h1>Your Daily Transactions</h1>
    <form id="transactions-form" method="POST">
        <label for="transaction_date">Date of Transaction:</label>
        <input type="date" id="transaction_date" name="transaction_date" value="<?php echo date('Y-m-d'); ?>" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" placeholder="Enter description" required>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" placeholder="Enter amount" required>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="Income">Income</option>
            <option value="Expenses">Expenses</option>
        </select>

        <input type="submit" value="Add Transaction">
    </form>

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

<?php include('../templates/footer.php'); ?>
<script src="transactions.js"></script>

</body>
</html>

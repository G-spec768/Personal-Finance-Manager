<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Initialize variables
$edit_mode = false;
$edit_id = '';
$category = '';
$amount = '';
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];
    $edit_id = $_POST['edit_id'] ?? '';

    if (!empty($edit_id)) {
        // Update the budget details
        $sql = "UPDATE budget SET category = ?, amount = ? WHERE user_id = ? AND id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdii", $category, $amount, $user_id, $edit_id);

        if ($stmt->execute()) {
            $message = "Category updated successfully!";
        } else {
            $message = "Error: Could not update the category.";
        }
    } else {
        // Insert new budget details
        $sql = "INSERT INTO budget (user_id, category, amount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isd", $user_id, $category, $amount);

        if ($stmt->execute()) {
            $message = "Category added successfully!";
        } else {
            $message = "Error: Could not add the category.";
        }
    }

    header('Location: budget.php?message=' . urlencode($message));
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM budget WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $delete_id, $_SESSION['user_id']);
    $stmt->execute();
    
    header('Location: budget.php?message=Category deleted successfully!');
    exit();
}

// Handle edit request
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql = "SELECT category, amount FROM budget WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $edit_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
        $category = $item['category'];
        $amount = $item['amount'];
        $edit_mode = true;
    }
}

// Fetch budget details
$sql = "SELECT id, category, amount FROM budget WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$budget_items = $result->fetch_all(MYSQLI_ASSOC);

// Display success message
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="budget_styles.css">
    <title>Manage Budget</title>
</head>
<body>
<?php include('../templates/user_header.php'); ?>
<div class="dashboard-container">
    <h1>Your Budget</h1>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    
    <form id="budget-form" method="POST">
        <input type="hidden" id="edit_id" name="edit_id" value="<?php echo htmlspecialchars($edit_id); ?>">

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="Groceries" <?php if ($category === 'Groceries') echo 'selected'; ?>>Groceries</option>
            <option value="Utilities" <?php if ($category === 'Utilities') echo 'selected'; ?>>Utilities</option>
            <option value="Entertainment" <?php if ($category === 'Entertainment') echo 'selected'; ?>>Entertainment</option>
            <option value="Transportation" <?php if ($category === 'Transportation') echo 'selected'; ?>>Transportation</option>
            <option value="Healthcare" <?php if ($category === 'Healthcare') echo 'selected'; ?>>Healthcare</option>
        </select>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" placeholder="Enter amount" value="<?php echo htmlspecialchars($amount); ?>" required>

        <input type="submit" value="<?php echo $edit_mode ? 'Update' : 'Add'; ?>">
    </form>

    <table id="budget-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($budget_items as $item): ?>
                <tr data-id="<?php echo $item['id']; ?>">
                    <td><?php echo htmlspecialchars($item['category'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($item['amount'] ?? ''); ?></td>
                    <td>
                        <a href="?edit=<?php echo $item['id']; ?>">Edit</a>
                        <a href="?delete=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../templates/footer.php'); ?>
</body>
</html>

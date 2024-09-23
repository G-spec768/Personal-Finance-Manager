<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/user_header.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="budget.php"><i class="fas fa-wallet"></i> Manage Budget</a></li>
                    <li><a href="transactions.php"><i class="fas fa-file-invoice-dollar"></i> Transactions</a></li>
                    <li><a href="savings_goals.php"><i class="fas fa-piggy-bank"></i> Savings Goals</a></li>
                    <li><a href="budget_overview.php"><i class="fas fa-chart-line"></i> Budget Overview</a></li>
                    <li><a href="all_settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
                
                <!-- <label for="theme-switcher">Choose a theme:</label>
                <select id="theme-switcher">
                    <option value="light-theme" <?php echo $current_theme === 'light-theme' ? 'selected' : ''; ?>>Light</option>
                    <option value="dark-theme" <?php echo $current_theme === 'dark-theme' ? 'selected' : ''; ?>>Dark</option>
                    <option value="solarized-theme" <?php echo $current_theme === 'solarized-theme' ? 'selected' : ''; ?>>Solarized</option>
                </select> -->
            </nav>
        </div>
    </header>
</body>
</html>

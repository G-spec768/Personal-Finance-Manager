Personal Finance Manager
The Personal Finance Manager is a web application that helps users manage their personal finances by tracking their income, expenses, savings, investments, and debts. The system allows users to log transactions, create budgets, and visualize their financial data through charts and tables.

Features
User Registration & Login:

Secure user authentication system.
Password hashing for secure storage.
Dashboard:

Users are redirected to their dashboard upon logging in.
Dashboard displays a summary of the user's financial data in a graph/chart format.
Budget Management:

Users can categorize their finances into Income, Expenses, Savings, Investments, Debt Repayment, and Financial Goals.
Ability to add, view, and manage budget categories.
Calculate the remaining amount from the income.
Transaction Management:

Users can log daily transactions including the date, description, amount, and type (Income/Expenses).
Transactions are displayed in a table for easy viewing.
Responsive Design:

The application is styled using CSS for a clean and responsive user interface.
Database:

All data is stored securely in a MySQL database.
Technologies Used
Frontend:
HTML5
CSS3
JavaScript
Backend:
PHP 7.x
MySQL
Database Tables:
users: Stores user information.
budgets: Stores budget categories and amounts.
transactions: Stores daily transaction data.
Installation
Prerequisites
XAMPP/MAMP/LAMP (or any other local server setup)
PHP 7.x or higher
MySQL (5.7 or higher)
Composer (optional for package management)
Steps
Clone the Repository:

bash
Copy code
git clone https://github.com/your-username/personal-finance-manager.git
Navigate to the Project Directory:

bash
Copy code
cd personal-finance-manager
Set Up the Database:

Create a MySQL database named personal_finance_db.
Import the provided SQL file located at /database/personal_finance_db.sql.
Configure the Database Connection:

Update the database connection settings in /config/db_connect.php with your MySQL credentials.
Run the Application:

Start your local server (XAMPP/MAMP/LAMP).
Access the application via your web browser at http://localhost/personal-finance-manager/public/.
Usage
Register:

Create an account by registering with a username, email, and password.
Login:

Log in using your credentials to access the dashboard.
Dashboard:

View a summary of your financial data, including graphs and tables.
Budget:

Navigate to the budget page to categorize and manage your finances.
Transactions:

Log your daily transactions and view them in a table format.
Logout:

Securely log out from your account.
Contributing
Contributions are welcome! Please fork this repository and submit a pull request for any features, bug fixes, or improvements.

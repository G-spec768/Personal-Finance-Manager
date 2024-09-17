    // Sample data for charts
    var expenseData = [300, 500, 200, 400];
    var incomeData = [15000];
    var budgetData = [1300];

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
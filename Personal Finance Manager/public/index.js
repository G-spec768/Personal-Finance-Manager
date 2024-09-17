
    // Sample data for charts
    var expenseData = [300, 500, 200, 400];
    var incomeData = [15000];
    var budgetData = [1300];

document.addEventListener('DOMContentLoaded', function() {
    var ctx1 = document.getElementById('expenseChart').getContext('2d');
    var expenseChart = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['Rent', 'Utilities', 'Food', 'Entertainment'],
            datasets: [{
                data: [30, 15, 20, 35],
                backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': $' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });

    var ctx2 = document.getElementById('incomeExpenseChart').getContext('2d');
    var incomeExpenseChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April'],
            datasets: [
                {
                    label: 'Income',
                    data: [3000, 3200, 2800, 3500],
                    backgroundColor: '#4bc0c0'
                },
                {
                    label: 'Expenses',
                    data: [2000, 1800, 1600, 2100],
                    backgroundColor: '#ff9f40'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': $' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
});

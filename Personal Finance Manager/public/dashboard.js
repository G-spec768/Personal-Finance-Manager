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
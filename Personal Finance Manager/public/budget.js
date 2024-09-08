document.getElementById('budget-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const category = document.getElementById('category').value;
    const amount = parseFloat(document.getElementById('amount').value) || 0;

    // Create a new row in the budget table
    const tableBody = document.querySelector('#budget-table tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${category}</td>
        <td>${amount.toFixed(2)}</td>
    `;
    tableBody.appendChild(newRow);

    // Optionally, clear the form fields
    document.getElementById('budget-form').reset();
});

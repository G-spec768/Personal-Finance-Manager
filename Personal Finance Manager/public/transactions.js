document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('transaction-form');
    const dateInput = document.getElementById('date');
    const descriptionInput = document.getElementById('description');
    const amountInput = document.getElementById('amount');
    const categoryInput = document.getElementById('category');

    // Ensure that the date input field only allows dates within the current month
    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

    dateInput.setAttribute('min', firstDay.toISOString().split('T')[0]);
    dateInput.setAttribute('max', lastDay.toISOString().split('T')[0]);

    // Form validation and AJAX submission
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Basic client-side validation
        if (!dateInput.value || !descriptionInput.value || !amountInput.value || !categoryInput.value) {
            alert('Please fill in all fields.');
            return;
        }

        if (amountInput.value <= 0) {
            alert('Amount must be greater than zero.');
            return;
        }

        // Collect form data
        const formData = new FormData(form);

        // Send data to the server via AJAX
        fetch('transactions.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Parse the response if needed
            if (data.includes('Success')) {
                // Reload the transactions table
                fetchTransactions();
                form.reset();
            } else {
                alert('Failed to add transaction.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing the request.');
        });
    });

    // Function to fetch transactions and update the table
    function fetchTransactions() {
        fetch('transactions.php')
        .then(response => response.text())
        .then(data => {
            // Insert the new transactions data into the table
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, 'text/html');
            const newTableBody = doc.querySelector('#transactions-table tbody');
            document.querySelector('#transactions-table tbody').innerHTML = newTableBody.innerHTML;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

document.getElementById('settings-form').addEventListener('submit', function(event) {
    // You can add additional client-side validation here if needed
    // For example, ensuring that a user selects at least one notification preference
    var notifications = document.querySelectorAll('input[name="notifications[]"]:checked');
    if (notifications.length === 0) {
        alert('Please select at least one notification preference.');
        event.preventDefault(); // Prevent form submission if validation fails
    }
});

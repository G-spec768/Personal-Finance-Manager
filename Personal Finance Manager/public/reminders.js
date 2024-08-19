document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reminder-form');
    
    form.addEventListener('submit', function(event) {
        const title = document.getElementById('title').value.trim();
        const reminderDate = document.getElementById('reminder_date').value;
        
        if (!title || !reminderDate) {
            alert('Title and reminder date are required.');
            event.preventDefault(); // Prevent form submission
        }
    });
});

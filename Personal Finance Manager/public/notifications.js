document.addEventListener('DOMContentLoaded', function() {
    // Example functionality: Mark notifications as read
    const notificationItems = document.querySelectorAll('.notification-item');

    notificationItems.forEach(item => {
        item.addEventListener('click', function() {
            this.classList.toggle('read');
        });
    });
});

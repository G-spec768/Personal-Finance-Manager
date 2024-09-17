// Profile Page Interactivity
document.addEventListener('DOMContentLoaded', () => {
    const profileForm = document.getElementById('profile-form');
    
    if (profileForm) {
        profileForm.addEventListener('submit', function (event) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            
            if (username === '' || email === '') {
                alert('Please fill out all fields.');
                event.preventDefault();
            } else {
                return confirm('Are you sure you want to update your profile?');
            }
        });
    }
});

// Settings Page Interactivity
document.addEventListener('DOMContentLoaded', () => {
    const settingsForm = document.getElementById('settings-form');
    
    if (settingsForm) {
        settingsForm.addEventListener('submit', function (event) {
            return confirm('Are you sure you want to save these settings?');
        });
        
        // Theme preview (if applicable)
        const themeRadios = document.querySelectorAll('input[name="theme"]');
        
        themeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'dark') {
                    document.body.classList.add('dark-theme');
                } else {
                    document.body.classList.remove('dark-theme');
                }
            });
        });
    }
});

// Notifications Page Interactivity
document.addEventListener('DOMContentLoaded', () => {
    // Example of sorting notifications
    const notificationsTable = document.getElementById('notifications-table');
    
    if (notificationsTable) {
        const headers = notificationsTable.querySelectorAll('th');
        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                sortTable(notificationsTable, index);
            });
        });
    }
});

function sortTable(table, column) {
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const sortedRows = rows.sort((a, b) => {
        const cellA = a.children[column].textContent.trim();
        const cellB = b.children[column].textContent.trim();
        return cellA.localeCompare(cellB, undefined, { numeric: true });
    });
    
    const tbody = table.querySelector('tbody');
    sortedRows.forEach(row => tbody.appendChild(row));
}

// Reminders Page Interactivity
document.addEventListener('DOMContentLoaded', () => {
    const reminderForm = document.getElementById('reminder-form');
    
    if (reminderForm) {
        const reminderDateInput = document.getElementById('reminder_date');
        if (reminderDateInput) {
            reminderDateInput.setAttribute('min', new Date().toISOString().split('T')[0]);
        }
        
        reminderForm.addEventListener('submit', function (event) {
            const title = document.getElementById('title').value.trim();
            const reminderDate = document.getElementById('reminder_date').value.trim();
            
            if (title === '' || reminderDate === '') {
                alert('Please fill out all fields.');
                event.preventDefault();
            } else {
                return confirm('Are you sure you want to set this reminder?');
            }
        });
        
        // Optional: Delete reminder functionality (if applicable)
        const deleteButtons = document.querySelectorAll('.delete-reminder');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                if (!confirm('Are you sure you want to delete this reminder?')) {
                    event.preventDefault();
                }
            });
        });
    }
});


// Password visibility toggle
document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    
    if (passwordInput && togglePassword) {
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    }
});

// Real-time email validation
document.addEventListener('input', (event) => {
    if (event.target.id === 'email') {
        const email = event.target.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            event.target.setCustomValidity('Invalid email format');
        } else {
            event.target.setCustomValidity('');
        }
    }
});

// Live theme preview
document.addEventListener('DOMContentLoaded', () => {
    const themeRadios = document.querySelectorAll('input[name="theme"]');
    
    themeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'dark') {
                document.body.classList.add('dark-theme');
            } else {
                document.body.classList.remove('dark-theme');
            }
        });
    });
});

// Reset settings confirmation
document.addEventListener('DOMContentLoaded', () => {
    const resetButton = document.getElementById('reset-settings');
    
    if (resetButton) {
        resetButton.addEventListener('click', (event) => {
            if (!confirm('Are you sure you want to reset settings to default?')) {
                event.preventDefault();
            }
        });
    }
});


// Filter notifications
document.addEventListener('DOMContentLoaded', () => {
    const filterSelect = document.getElementById('notification-filter');
    
    if (filterSelect) {
        filterSelect.addEventListener('change', function () {
            const filterValue = this.value;
            const rows = document.querySelectorAll('#notifications-table tbody tr');
            
            rows.forEach(row => {
                const type = row.children[1].textContent.trim();
                if (filterValue === 'all' || type === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});

// Mark notifications as read
document.addEventListener('DOMContentLoaded', () => {
    const markAsReadButtons = document.querySelectorAll('.mark-as-read');
    
    markAsReadButtons.forEach(button => {
        button.addEventListener('click', function () {
            this.parentElement.parentElement.classList.add('read');
            // Optionally send an AJAX request to update the read status in the backend
        });
    });
});


// Edit and delete reminders
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-reminder');
    const deleteButtons = document.querySelectorAll('.delete-reminder');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Implement edit functionality, e.g., open a modal with pre-filled data
            const row = this.closest('tr');
            const title = row.children[0].textContent.trim();
            const description = row.children[1].textContent.trim();
            const date = row.children[2].textContent.trim();
            
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('reminder_date').value = date;
            // Optionally open an edit modal
        });
    });
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            if (!confirm('Are you sure you want to delete this reminder?')) {
                event.preventDefault();
            }
        });
    });
});

// Search and filter reminders
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('reminder-search');
    
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#reminders-table tbody tr');
            
            rows.forEach(row => {
                const title = row.children[0].textContent.toLowerCase();
                if (title.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Check for saved theme in localStorage
    const savedTheme = localStorage.getItem('theme') || 'light-theme';
    document.body.classList.add(savedTheme);

    // Add event listener for theme switcher (assuming a theme switcher exists)
    const themeSwitcher = document.getElementById('theme-switcher');
    if (themeSwitcher) {
        themeSwitcher.addEventListener('change', (event) => {
            const selectedTheme = event.target.value;
            document.body.classList.remove('light-theme', 'dark-theme', 'solarized-theme');
            document.body.classList.add(selectedTheme);
            localStorage.setItem('theme', selectedTheme); // Save the selected theme
        });
    }
});


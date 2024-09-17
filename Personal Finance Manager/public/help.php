<?php
// No session check needed, so you can omit the session_start() and login redirect

// Include header
include('../templates/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & FAQ</title>
    <link rel="stylesheet" href="css/help.css"> <!-- Link to your CSS -->
</head>
<body>
    <div class="help-container">
        <h1>Help & FAQ</h1>

        <!-- Searchable FAQ Section -->
        <div class="faq-search">
            <input type="text" id="faq-search" placeholder="Search FAQ...">
        </div>

        <div class="faq-section" id="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <div class="faq-question">Question 1: How do I register an account?</div>
                <div class="faq-answer">Answer: To register, click on the "Register" link on the homepage, fill in your details, and submit the form.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Question 2: How do I register an account?</div>
                <div class="faq-answer">To register, click on the "Register" link on the homepage, fill in your details, and agree to the terms and conditions before submitting the form.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">Question 3: How can I reset my password?</div>
                <div class="faq-answer">If you forget your password, click on the "Forgot Password" link on the login page, and follow the instructions to reset it via email.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Question 4: How do I update my profile?</div>
                <div class="faq-answer">To update your profile, go to the 'Profile' page after logging in...</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Question 5: What is Personal Finance Manager?</div>
                <div class="faq-answer">Personal Finance Manager is a tool designed to help you manage your finances by tracking expenses, setting budgets, and monitoring your savings goals.</div>
            </div>
    

            <!-- Add more FAQ items relevant to new users -->
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <h2>Need More Help?</h2>
            <form id="contact-form" method="POST" action="../src/send_support_request.php">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" required></textarea>
                
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <!-- Include footer -->
    <?php include('../templates/footer.php'); ?>

    <script src="help.js"></script> <!-- Link to your JS -->
</body>
</html>

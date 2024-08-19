document.addEventListener('DOMContentLoaded', function () {
    // FAQ Search Functionality
    const searchInput = document.getElementById('faq-search');
    const faqItems = document.querySelectorAll('.faq-item');

    searchInput.addEventListener('keyup', function () {
        const query = searchInput.value.toLowerCase();

        faqItems.forEach(function (item) {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

            if (question.includes(query) || answer.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Toggle FAQ Answer Visibility
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(function (question) {
        question.addEventListener('click', function () {
            const answer = this.nextElementSibling;

            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });
});

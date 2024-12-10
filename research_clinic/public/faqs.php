<?php
include('../db/DBConn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Clinic - FAQs</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/faq.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
</head>

<body>
    <?php include('../includes/header.php'); ?>

    <!-- FAQ Page -->
    <section id="faq-page" class="faq-page">
        <div class="container">
            <h1 class="faq-title">Frequently Asked Questions</h1>
            <p class="faq-description">Here are some of the most common questions we receive. If you don't find what you're looking for, feel free to contact us!</p>
        </div>

        <!-- FAQ Accordion -->
        <div class="faq-content">
            <div class="container">
                <div class="faq-item">
                    <button class="faq-btn">What services do you offer?</button>
                    <div class="faq-answer">
                        <p>We offer a variety of services, including thesis and dissertation support, data analysis, professional writing, and training programs in various fields.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-btn">How can I enroll in a course?</button>
                    <div class="faq-answer">
                        <p>You can enroll in a course by visiting the "Courses" page and selecting the course you're interested in. You will need to log in to complete the enrollment process.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-btn">How do I submit my thesis?</button>
                    <div class="faq-answer">
                        <p>Once you're ready to submit your thesis, our team will guide you through the process. You can upload your thesis via our online portal once you’ve logged in.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-btn">What is the cost of your services?</button>
                    <div class="faq-answer">
                        <p>The cost of our services varies depending on the type of service you need. Please contact us for a quote or refer to our pricing section for more details.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-btn">Can I get a certificate after completing a course?</button>
                    <div class="faq-answer">
                        <p>Yes, upon successful completion of any of our training programs, you will receive a certificate of completion that you can use to enhance your academic or professional profile.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-btn">How do I contact support?</button>
                    <div class="faq-answer">
                        <p>You can contact our support team through the "Contact Us" page or by emailing support@researchclinic.com.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('../includes/footer.php'); ?>

    <!-- Optional JavaScript -->
    <script>
        // Accordion functionality
        const faqBtns = document.querySelectorAll('.faq-btn');
        faqBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const answer = btn.nextElementSibling;
                const isActive = answer.style.display === 'block';

                // Toggle display
                answer.style.display = isActive ? 'none' : 'block';
            });
        });
    </script>
</body>

</html>

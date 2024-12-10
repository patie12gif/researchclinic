<?php
include('../db/DBConn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Clinic - Testimonials</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/testimonials.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
</head>

<body>
    <?php include('../includes/header.php'); ?>

    <!-- Testimonials Page -->
    <section id="testimonials-page" class="testimonials-page">
        <div class="container">
            <h1 class="testimonials-title">What Our Clients Say</h1>
            <p class="testimonials-description">We are proud of the work we do and the impact we have on our clients. Here’s what some of our clients have to say about their experience with Research Clinic.</p>
        </div>

        <!-- Testimonials Grid -->
        <section class="testimonials-content">
            <div class="container">
                <div class="testimonials-grid">
                    <!-- Testimonial 1 -->
                    <div class="testimonial-card">
                        <div class="testimonial-body">
                            <p class="testimonial-text">"The thesis support I received from Research Clinic was exceptional. Their team provided expert guidance every step of the way."</p>
                            <h4 class="testimonial-name">Yanzy</h4>
                            <p class="testimonial-position">PhD Candidate</p>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="testimonial-card">
                        <div class="testimonial-body">
                            <p class="testimonial-text">"I enrolled in a professional writing program, and it greatly improved my research papers. The instructors were fantastic!"</p>
                            <h4 class="testimonial-name">Tarce</h4>
                            <p class="testimonial-position">Researcher</p>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="testimonial-card">
                        <div class="testimonial-body">
                            <p class="testimonial-text">"The data analysis service was thorough and professional. I couldn’t have completed my research without it."</p>
                            <h4 class="testimonial-name">Anotidaishe</h4>
                            <p class="testimonial-position">Data Analyst</p>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="testimonial-card">
                        <div class="testimonial-body">
                            <p class="testimonial-text">"Research Clinic's training programs are incredibly insightful. They have helped me enhance my skills in data collection and analysis."</p>
                            <h4 class="testimonial-name">Vitu</h4>
                            <p class="testimonial-position">Research Assistant</p>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="testimonial-card">
                        <div class="testimonial-body">
                            <p class="testimonial-text">"The level of expertise and professionalism at Research Clinic is unmatched. I highly recommend their services to anyone in academia."</p>
                            <h4 class="testimonial-name">Tay</h4>
                            <p class="testimonial-position">Graduate Student</p>
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="testimonial-card">
                        <div class="testimonial-body">
                            <p class="testimonial-text">"I was struggling with my thesis, but Research Clinic made the process so much easier. Their support was a game-changer!"</p>
                            <h4 class="testimonial-name">Yvonne</h4>
                            <p class="testimonial-position">Master’s Student</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <?php include('../includes/footer.php'); ?>

</body>

</html>

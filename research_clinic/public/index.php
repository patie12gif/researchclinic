<?php
include('../db/DBConn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Clinic</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/reset.css">
<link rel="stylesheet" href="../assets/css/base.css">
<link rel="stylesheet" href="../assets/css/layout.css">
<link rel="stylesheet" href="../assets/css/header.css">
<link rel="stylesheet" href="../assets/css/hero.css">
<link rel="stylesheet" href="../assets/css/about.css">
<link rel="stylesheet" href="../assets/css/services.css">
<link rel="stylesheet" href="../assets/css/courses.css">
<link rel="stylesheet" href="../assets/css/testimonials.css">
<link rel="stylesheet" href="../assets/css/resources.css">
<link rel="stylesheet" href="../assets/css/user-account.css">
<link rel="stylesheet" href="../assets/css/footer.css">
<link rel="stylesheet" href="../assets/css/theme.css">

</head>

<body>
    <?php include('../includes/header.php'); ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Empowering Knowledge, Skills, and Development</h1>
            <p>Join our community of researchers, students, and professionals for the best learning experience in research, data analysis, and more.</p>
            <a href="services.php" class="cta-btn">Explore Our Services</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="aboutt" class="about">
        <div class="about-content">
            <h2>About Research Clinic</h2>
            <p>Research Clinic is a leading consultancy based in Malawi, offering thesis and dissertation support, professional writing, data analysis, and research services. We specialize in training programs across various fields, from business to community development, all designed to foster personal and professional growth.</p>
            <a href="about-us.php" class="cta-link">Learn More</a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <h2>Our Services</h2>
        <div class="services-container">
            <div class="service-card">
                <h3>Thesis and Dissertation Support</h3>
                <p>Get expert guidance for your thesis or dissertation from start to finish. Our experienced researchers are here to help you succeed.</p>
                <a href="services.php" class="cta-btn">Learn More</a>
            </div>
            <div class="service-card">
                <h3>Online Learning Programs</h3>
                <p>Explore our range of online courses designed to enhance your skills in business, marketing, HR management, and more.</p>
                <a href="online-courses.php" class="cta-btn">Explore Courses</a>
            </div>
            <div class="service-card">
                <h3>Data Analysis and Research Services</h3>
                <p>Utilize our expertise in data collection, analysis, and reporting to drive your research projects to success.</p>
                <a href="services.php" class="cta-btn">Learn More</a>
            </div>
        </div>
    </section>

  <!-- Featured Courses Section -->
<section id="courses" class="courses">
    <h2>Featured Courses</h2>
    <div class="courses-container">
        <div class="course-card">
            <h3>Data Analysis Techniques</h3>
            <p>Learn the best techniques to analyze data in research projects with our comprehensive course.</p>
            <a href="online-courses.php" class="cta-btn">Enroll Now</a>
        </div>
        <div class="course-card">
            <h3>Research Methodologies</h3>
            <p>Gain insights into the methodologies behind successful research projects and understand best practices in the field.</p>
            <a href="online-courses.php" class="cta-btn">Enroll Now</a>
        </div>
        <div class="course-card">
            <h3>Project Management for Research</h3>
            <p>Master the skills needed to manage complex research projects effectively, from planning to execution.</p>
            <a href="online-courses.php" class="cta-btn">Enroll Now</a>
        </div>
    </div>
</section>


   <!-- Testimonials Section -->
<section id="testimonials" class="testimonials">
    <h2>What Our Clients Say</h2>
    <div class="testimonials-container">
        <div class="testimonial">
            <p>"Research Clinic provided me with the best resources for my research project. The knowledge I gained was invaluable. I highly recommend their services!"</p>
            <span>- Tarliq Lucky Taecks</span>
        </div>
        <div class="testimonial">
            <p>"The online courses offered by Research Clinic are top-notch. They were comprehensive, insightful, and directly applicable to my career."</p>
            <span>- Peace S Phiri</span>
        </div>
    </div>
</section>

<!-- Resources Section -->
<section id="resources" class="resources">
    <h2>Resources</h2>
    <div class="resources-container">
        <div class="blog-post">
            <h3>How to Write a Research Paper</h3>
            <p>Discover best practices for writing a research paper from start to finish.</p>
            <a href="resources.php" class="read-more-btn">Read More</a>
        </div>
        <div class="blog-post">
            <h3>Tips for Successful Grant Applications</h3>
            <p>Learn strategies for writing winning grant applications and securing funding.</p>
            <a href="resources.php" class="read-more-btn">Read More</a>
        </div>
    </div>
</section>

<?php include('../includes/footer.php'); ?>
</body>

</html>

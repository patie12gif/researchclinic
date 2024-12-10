<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Clinic</title>
    <link rel="stylesheet" href="db/css/style.css">
</head>

<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="nav">
            <div class="logo">
                <a href="index.php" class="logo-text">Research Clinic</a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="online-courses.php">Online Courses</a></li>
                <li><a href="resources.php">Resources & Blog</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">More</a>
                    <ul class="dropdown-content">
                        <li><a href="user-account.php">User Account</a></li>
                        <li><a href="testimonials.php">Testimonials</a></li>
                        <li><a href="faqs.php">FAQs</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="login.php" class="dropbtn">Login</a>
                    <ul class="dropdown-content">
                        <li><a href="student-login.php">Student Login</a></li>
                        <li><a href="lecturer-login.php">Lecturer Login</a></li>
                        <li><a href="admin-login.php">Admin Login</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Empowering Knowledge, Skills, and Development</h1>
                <p>Join our community of researchers, students, and professionals for the best learning experience in research, data analysis, and more.</p>
                <a href="services.php" class="cta-btn">Explore Our Services</a>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="about">
            <h2>About Us</h2>
            <p>Research Clinic is a leading consultancy based in Malawi, offering thesis and dissertation support, professional writing, data analysis, and research services. We specialize in training programs across various fields, from business to community development, all designed to foster personal and professional growth.</p>
            <a href="about-us.php" class="cta-link">Learn More</a>
        </section>

        <!-- Services Section -->
        <section class="services">
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
        <section class="courses">
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
        <section class="testimonials">
            <h2>What Our Clients Say</h2>
            <div class="testimonial">
                <p>"Research Clinic provided me with the best resources for my research project. The knowledge I gained was invaluable. I highly recommend their services!"</p>
                <span>- Tarliq Lucky Taecks</span>
            </div>
            <div class="testimonial">
                <p>"The online courses offered by Research Clinic are top-notch. They were comprehensive, insightful, and directly applicable to my career."</p>
                <span>- Peace S Phiri</span>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> Research Clinic. All rights reserved.</p>
            <ul class="social-links">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">LinkedIn</a></li>
            </ul>
        </div>
    </footer>

    <script>
        // Highlight active nav link
        const navLinks = document.querySelectorAll('.nav-links a');
        navLinks.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    </script>
</body>

</html>

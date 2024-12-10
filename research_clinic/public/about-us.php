<?php
include('../db/DBConn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Research Clinic</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/about.css">
	<link rel="stylesheet" href="../assets/css/footer.css">
</head>

<body>
    <?php include('../includes/header.php'); ?>

   <section id="about" class="about">
    <div class="about-content">
        <div class="about-text">
        <h2>Our Story</h2>
            <p>Research Clinic was founded with the goal of helping researchers, students, and professionals navigate the often complex world of research. We provide comprehensive research services, data analysis, and training designed to support and empower individuals in their research endeavors.</p>
            <p>Our team consists of highly experienced professionals with diverse backgrounds in research and academia, working together to provide the best possible resources and support.</p>    
		</div>
        <div class="about-image">
      <img src="../assets/images/about.jpg" alt="About Us Image Research Clinic">
        </div>
    </div>
</section>

    <!-- Mission and Vision Section -->
    <section class="mission-vision">
        <div class="container">
            <h2>Our Mission</h2>
            <p>Our mission is to provide top-quality research consultancy, training, and resources that empower individuals to succeed in their academic and professional research projects. We aim to bridge the gap between research theory and practice, offering practical, actionable advice and support to our clients.</p>

            <h2>Our Vision</h2>
            <p>Our vision is to be a global leader in research support, known for excellence, integrity, and innovation. We aspire to create an environment where researchers, students, and professionals can thrive through the power of knowledge, training, and resources that make a difference in the research landscape.</p>
        </div>
    </section>

    <!-- Meet the Team Section -->
    <section class="meet-the-team">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-members">
                <div class="team-member">
                    <img src="../assets/images/6.jpg" alt="Ada Ngwazi">
                    <h3>Ada Ngwazi</h3>
                    <p>Director</p>
                </div>
                <div class="team-member">
                    <img src="../assets/images/3.jpg" alt="Ulemu Sinoya">
                    <h3>Ulemu Sinoya</h3>
                    <p>Financial Accounts Manager</p>
                </div>
				<div class="team-member">
                    <img src="../assets/images/8.jpg" alt="Dorothy Chipeta">
                    <h3>Paul Bednock Saka</h3>
                    <p>Subject Matter Expert</p>
                </div>
				<div class="team-member">
                    <img src="../assets/images/4.jpg" alt="Charles Dokera">
                    <h3>Charles Dokera</h3>
                    <p>Legal Advisor</p>
                </div>
                <div class="team-member">
                    <img src="../assets/images/5.jpg" alt="Brown Kenani">
                    <h3>Brown Kenani</h3>
                    <p>Educational Expert</p>
                </div>
                <div class="team-member">
                    <img src="../assets/images/2.jpg" alt="Dorothy Chipeta">
                    <h3>Dorothy Chipeta</h3>
                    <p>Marketing Manager</p>
					</div>
					 <div class="team-member">
                    <img src="../assets/images/1.jpg" alt="Wilson Lawlings Phiri">
                    <h3>Wilson Lawlings Phiri</h3>
                    <p>Research Team</p>
                </div>
				 <div class="team-member">
                    <img src="../assets/images/7.jpg" alt="Peace Salomy Phiri">
                    <h3>Peace Salomy Phiri</h3>
                    <p>IT Systems Manager</p>
                 </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Explore Our Services</h2>
            <p>We offer a range of services that can help you with every stage of your research project, from planning and methodology to analysis and reporting. Our experts are here to guide you through the process and ensure you succeed.</p>
            <a href="services.php" class="cta-btn">Explore Services</a>
        </div>
    </section>

    <?php include('../includes/footer.php'); ?>
</body>

</html>

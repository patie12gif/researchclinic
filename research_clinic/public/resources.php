<?php
include('../db/DBConn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Clinic - Blog and Resources</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/resources.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
</head>

<body>
    <?php include('../includes/header.php'); ?>

    <!-- Blog and Resources Page -->
    <section id="blog-resources-page" class="blog-resources-page">
        <div class="container">
            <h1 class="blog-title">Blog & Resources</h1>
            <p class="blog-description">Explore the latest blog posts and valuable resources to help you succeed in your academic and professional endeavors.</p>
        </div>

        <!-- Blog Section -->
        <section class="blog-content">
            <div class="container">
                <h2 class="section-title">Recent Blog Posts</h2>
                <div class="blog-grid">
                    <!-- Blog Post 1 -->
                    <div class="blog-card">
                        <h3 class="blog-post-title">How to Write a Winning Thesis</h3>
                        <p class="blog-post-excerpt">Discover the key steps to crafting a well-structured and compelling thesis. From research to writing, we guide you every step of the way.</p>
                        <a href="blog-post-1.php" class="blog-link">Read More</a>
                    </div>

                    <!-- Blog Post 2 -->
                    <div class="blog-card">
                        <h3 class="blog-post-title">Data Analysis for Beginners</h3>
                        <p class="blog-post-excerpt">Learn the basics of data analysis and how it can enhance your research. A must-read for students and professionals alike.</p>
                        <a href="blog-post-2.php" class="blog-link">Read More</a>
                    </div>

                    <!-- Blog Post 3 -->
                    <div class="blog-card">
                        <h3 class="blog-post-title">Effective Research Strategies</h3>
                        <p class="blog-post-excerpt">Master the art of research with our tips and strategies to help you gather accurate data and write impactful papers.</p>
                        <a href="blog-post-3.php" class="blog-link">Read More</a>
                    </div>

                    <!-- Blog Post 4 -->
                    <div class="blog-card">
                        <h3 class="blog-post-title">Top Tips for Professional Writing</h3>
                        <p class="blog-post-excerpt">Professional writing is a skill that can be learned. Explore our tips to improve your writing style and create polished, professional documents.</p>
                        <a href="blog-post-4.php" class="blog-link">Read More</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Resources Section -->
        <section class="resources-content">
            <div class="container">
                <h2 class="section-title">Useful Resources</h2>
                <div class="resources-grid">
                    <!-- Resource 1 -->
                    <div class="resource-card">
                        <h3 class="resource-title">Thesis Writing Guide</h3>
                        <p class="resource-description">A comprehensive guide on how to structure and write your thesis, including tips on citation and formatting.</p>
                        <a href="thesis-guide.php" class="resource-link">Access Resource</a>
                    </div>

                    <!-- Resource 2 -->
                    <div class="resource-card">
                        <h3 class="resource-title">Data Analysis Tools</h3>
                        <p class="resource-description">Explore the best tools and software for data analysis. Perfect for researchers looking to analyze complex datasets.</p>
                        <a href="data-analysis-tools.php" class="resource-link">Access Resource</a>
                    </div>

                    <!-- Resource 3 -->
                    <div class="resource-card">
                        <h3 class="resource-title">Research Paper Templates</h3>
                        <p class="resource-description">Download free research paper templates that will help you format and organize your academic papers.</p>
                        <a href="research-paper-templates.php" class="resource-link">Access Resource</a>
                    </div>

                    <!-- Resource 4 -->
                    <div class="resource-card">
                        <h3 class="resource-title">Writing & Citation Resources</h3>
                        <p class="resource-description">A collection of writing and citation resources to help you cite your sources properly and avoid plagiarism.</p>
                        <a href="writing-citation-resources.php" class="resource-link">Access Resource</a>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <?php include('../includes/footer.php'); ?>

</body>

</html>

<?php
session_start();  
include('../db/DBConn.php');  

 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');  
    exit;
}

$username = $_SESSION['username'];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/hero.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css"> 
	<link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php include('../includes/header.php'); ?>

 
    <section id="student-dashboard">
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Manage your courses, assignments, and more.</p>

          
            <div class="dashboard-options">
                <div class="option">
                    <h3>My Courses</h3>
                    <a href="student-courses.php">View Courses</a>
                </div>
                <div class="option">
                    <h3>Assignments</h3>
                    <a href="student-assignments.php">View Assignments</a>
                </div>
                <div class="option">
                    <h3>Grades</h3>
                    <a href="student-grades.php">View Grades</a>
                </div>
                <div class="option">
                    <h3>Profile</h3>
                    <a href="student-profile.php">View Profile</a>
                </div>
            </div>
        </div>
    </section>

    <?php include('../includes/footer.php'); ?>
</body>
</html>

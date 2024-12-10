<?php
include('../db/DBConn.php');

 
require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
     
    $sql = "INSERT INTO contact_requests (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $phone, $subject, $message);
    
    if (mysqli_stmt_execute($stmt)) {
        send_confirmation_email($email, $name, $subject);
        echo "<script>alert('Your message has been sent successfully!');</script>";
    } else {
        echo "<script>alert('Failed to send your message. Please try again later.');</script>";
    }
}

 
function send_confirmation_email($email, $name, $subject) {
    $mail = new PHPMailer(true);
    try {
            
        $mail->isSMTP();                                  
        $mail->Host = 'smtp.gmail.com';                     
        $mail->SMTPAuth = true;                           
        $mail->Username = 'talujay2@gmail.com'; 
        $mail->Username = 'patiencedzanja44@gmail.com';           
        $mail->Password = 'czfy dgxi mktb algd';              
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port = 587;                                

      
        $mail->setFrom('talujay2@gmail.com', 'Research Clinic');
        $mail->addAddress($email, $name);

       
        $mail->isHTML(true);
        $mail->Subject = 'Contact Us Submission Confirmation';
        $mail->Body    = "Hello $name,<br><br>Thank you for contacting us! We have received your message with the subject: '$subject'. We will get back to you shortly.<br><br>Best regards,<br>Research Clinic Team";

        $mail->send();
    } catch (Exception $e) {
        error_log("Mailer error: " . $mail->ErrorInfo);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Contact Us Section */
        #contact-us {
            padding: 50px 15px;
            background-color: #f4f7fb;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        #contact-us .container {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two equal columns */
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        #contact-us h1, .contact-info h3 {
            font-size: 2.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        #contact-us p {
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 30px;
            color: #555;
            grid-column: span 2; /* Makes the paragraph span both columns */
        }

        .contact-form,
        .contact-info {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            font-size: 1.1em;
            color: #333;
        }

        form input, form textarea {
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        form button {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        form button:focus {
            outline: none;
        }

        .contact-detail ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-detail ul li {
            margin-bottom: 12px;
            font-size: 1.1em;
        }

        .contact-detail ul li a {
            text-decoration: none;
            color: #007BFF;
        }

        .contact-detail ul li a:hover {
            text-decoration: underline;
        }

        .contact-detail h4 {
            font-size: 1.6em;
            color: #333;
            margin-bottom: 15px;
        }

        /* Google Map Section */
        #map {
            margin-top: 50px;
            height: 400px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icons a {
            color: #007BFF;
            font-size: 1.6em;
        }

        .social-icons a:hover {
            color: #0056b3;
        }

        /* Media Queries */
        @media screen and (max-width: 768px) {
            #contact-us .container {
                grid-template-columns: 1fr; /* Stacks the sections on mobile */
                gap: 20px;
            }

            .contact-form,
            .contact-info {
                max-width: 100%; /* Full width on mobile */
            }

            .social-icons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <section id="contact-us">
        <div class="container">
            <!-- Contact Form -->
            <div class="contact-form">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you! Please fill out the form below to get in touch.</p>
                <form action="contact-us.php" method="POST">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" title="Enter a 10-digit phone number">

                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Send</button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h3>Contact Information</h3>
                <div class="contact-detail">
                    <h4>Our Office</h4>
                    <ul>
                        <li><strong>Address:</strong> Area 14, Lilongwe, Malawi</li>
                        <li><strong>Email:</strong> <a href="mailto: vituchawazamw265@gmail.com">vituchawaza265@gmail</a></li>
                        <li><strong>Phone:</strong> +265 993970998</li>
                    
                        <li><strong>Phone:</strong> +265 885660440</li>
                        
                        <li><strong>Working Hours:</strong> Mon-Fri, 8:00 AM - 5:00 PM</li>
                    </ul>
                </div>
                <div class="contact-detail">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Map Section -->
    <section id="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247812.07740119137!2d33.62774924699225!3d-13.9548122359202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1921d31ffc299805%3A0x4b7eb9f20a03ff9!2sLilongwe%2C%20Malawi!5e0!3m2!1sen!2sza!4v1733187992810!5m2!1sen!2sza" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <?php include('../includes/footer.php'); ?>
</body>
</html>















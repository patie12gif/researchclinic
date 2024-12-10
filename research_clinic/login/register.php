<?php
session_start();
include('../db/DBConn.php'); // Include database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';
require '../vendor/PHPMailer/src/Exception.php';

 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
 
    if ($password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit;
    }
 
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

 
    $sql = "INSERT INTO users (username, email, password_hash, role, status) VALUES (?, ?, ?, 'student', 'pending')";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
    
        mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password_hash);
        if (mysqli_stmt_execute($stmt)) {
           
            $mail = new PHPMailer(true);

            try {
                
                $mail->isSMTP();                                   
                $mail->Host = 'smtp.gmail.com';                    
                $mail->SMTPAuth = true;                            
                $mail->Username = 'talujay2@gmail.com';             
                $mail->Password = 'czfy dgxi mktb algd';         
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
                $mail->Port = 587;                                

                 
                $mail->setFrom('talujay2@gmail.com', 'Research Clinic');  
                $mail->addAddress($email, $username);             

                
                $mail->isHTML(true);                             
                $mail->Subject = 'Registration Pending';

               
                $mail->Body = '
                    <html>
                    <head>
                        <style>
                            body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; background-color: #f4f7fc; margin: 0; padding: 0; }
                            .container { max-width: 600px; margin: 50px auto; padding: 40px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); }
                            h2 { color: #333; font-size: 28px; text-align: center; }
                            p { font-size: 16px; color: #555; line-height: 1.6; text-align: center; }
                            .button { background-color: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px; font-size: 16px; }
                            .footer { font-size: 12px; color: #888; text-align: center; margin-top: 30px; }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h2>Hello ' . htmlspecialchars($username) . ',</h2>
                            <p>Thank you for registering at Research Clinic. Your registration is currently <strong>pending approval</strong> by an admin.</p>
                            <p>You will be notified via email once your account has been approved, and you can begin using the platform.</p>
                            <p>If you have any questions, feel free to contact us.</p>
                            <p><a href="https://www.researchclinic.com" class="button">Visit Research Clinic</a></p>
                            <p class="footer">Best regards,<br>The Research Clinic Team</p>
                        </div>
                    </body>
                    </html>';

               
                $mail->send();
                echo 'Registration successful. Your account is pending approval. A confirmation email has been sent.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <style>
        body {
       font-family: 'Arial', sans-serif;
       background-color: #f4f7fc;
       display: flex;
       justify-content: center;
       align-items: center;
       height: 100vh; /* Full viewport height */
       text-align: center;
       }
        .form-container {
	    background-color: #ffffff; 
		border-radius: 8px; 
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		padding: 40px; width: 100%; max-width: 600px; }
		
        .form-header {
		text-align: center; 
		margin-bottom: 20px; }
		
        .form-header h1 {
		font-size: 28px;
		color: #007bff }
		
        label { 
		font-size: 16px;
		color: #333;
		margin-bottom: 5px;
		display: block; }
		
        input[type="text"], input[type="email"], input[type="password"] {
		width: 100%; 
		padding: 12px;
		margin: 10px 0; 
		border: 1px solid #ddd;
		border-radius: 5px;
		font-size: 16px;
		outline: none; }
		
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus { 
		border-color: #007bff; }
		
        button[type="submit"] {
		width: 100%;
		padding: 15px;
		background-color: #007bff;
		color: white;
		font-size: 18px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		transition: background-color 0.3s ease; }
		
        button[type="submit"]:hover { 
		background-color: #007bff; }
        
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Create Your Account</h1>
        </div>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

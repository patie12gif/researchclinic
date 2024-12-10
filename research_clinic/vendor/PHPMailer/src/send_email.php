<?php

include('../../db/DBConn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../../vendor/PHPMailer/src/Exception.php';
require '../../vendor/PHPMailer/src/PHPMailer.php';
require '../../vendor/PHPMailer/src/SMTP.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login/login.php'); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_id'], $_POST['action'])) {
    $application_id = $_POST['application_id'];
    $action = $_POST['action']; 


    $sql = "SELECT name, email, program FROM applications WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $application_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name, $email, $program);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $status = ($action === 'accept') ? 1 : 2; // 1 = Accepted, 2 = Rejected
    $update_sql = "UPDATE applications SET status = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, 'ii', $status, $application_id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);

   
    send_status_email($email, $name, $program, $action);

    header('Location: admin-dashboard.php'); 
    exit;
}

function send_status_email($to, $name, $program, $action) {
    $mail = new PHPMailer();
    try {
                     // Server settings
                $mail->isSMTP();                                 
                $mail->Host = 'smtp.gmail.com';                   
                $mail->SMTPAuth = true;                            
                $mail->Username = 'talujay2@gmail.com';           
                $mail->Password = 'czfy dgxi mktb algd';          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
                $mail->Port = 587;                                

       
        $mail->setFrom('talujay2@gmail.com', 'Research Clinic');
        $mail->addAddress($to); 

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Your Application Status";

        if ($action === 'accept') {
            $mail->Body = "<p>Hello $name,</p><p>Congratulations! Your application for the '$program' program has been accepted. You can now proceed to register.</p>";
        } else {
            $mail->Body = "<p>Hello $name,</p><p>We regret to inform you that your application for the '$program' program has been rejected. We wish you the best in your future endeavors.</p>";
        }

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


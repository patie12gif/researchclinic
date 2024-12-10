<?php
session_start();
// Connect to the database
    include('../db/DBConn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
		
        require __DIR__ . '../../vendor/phpmailer/src/PHPMailer.php';
        require __DIR__ . '../../vendor/phpmailer/src/SMTP.php';
        require __DIR__ . '../../vendor/phpmailer/src/Exception.php';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
  
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $program = isset($_POST['program']) ? htmlspecialchars($_POST['program']) : '';
    $uploaded_files = [];


    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }


if (!empty($_FILES['application_form']['name'])) {
    $application_form_path = $upload_dir . basename($_FILES['application_form']['name']);
    $allowed_types = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf'];
    $max_file_size = 10 * 1024 * 1024; 

    if (in_array($_FILES['application_form']['type'], $allowed_types) && $_FILES['application_form']['size'] <= $max_file_size) {
        if (move_uploaded_file($_FILES['application_form']['tmp_name'], $application_form_path)) {
            $uploaded_files[] = $application_form_path;
        } else {
            echo "Error uploading application form.";
        }
    } else {
        echo "Invalid file type or size for the application form.";
    }
}

if (!empty($_FILES['supporting_docs']['name'][0])) {
    foreach ($_FILES['supporting_docs']['name'] as $key => $filename) {
        $file_path = $upload_dir . basename($filename);
        $allowed_types = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'image/jpeg', 'image/png'];

        if (in_array($_FILES['supporting_docs']['type'][$key], $allowed_types) && $_FILES['supporting_docs']['size'][$key] <= $max_file_size) {
            if (move_uploaded_file($_FILES['supporting_docs']['tmp_name'][$key], $file_path)) {
                $uploaded_files[] = $file_path;
            } else {
                echo "Error uploading file: $filename";
            }
        } else {
            echo "Invalid file type or size for the file: $filename";
        }
    }
}


    
    $sql = "INSERT INTO applications (name, email, program, files) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $files_json = json_encode($uploaded_files);
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $program, $files_json);
    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='success'>Application submitted successfully!</div>";

       

        send_application_email($email, $name, $program); 

       
        header('Location: thank-you.php'); 
        exit;
    } else {
        echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
    }
}


function send_application_email($to, $name, $program) {
   $mail = new PHPMailer(); 
    try {
        
        $mail->isSMTP();                                  
        $mail->Host = 'smtp.gmail.com';                   
        $mail->SMTPAuth = true;                           
        $mail->Username = 'talujay2@gmail.com';          
        $mail->Password = 'czfy dgxi mktb algd';             
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port = 587;                                

        
        $mail->setFrom('talujay2@gmail.com', 'Research Clinic');
        $mail->addAddress($to); 

        
        $mail->isHTML(true);
        $mail->Subject = "Your Application Submission";
        $mail->Body = "<p>Hello $name,</p><p>Your application for the program '$program' has been submitted successfully. We will notify you once your application is reviewed.</p><p>Thank you for applying!</p>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for a Program</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #444;
            text-align: center;
        }
        p {
            text-align: center;
        }
        a.button {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        a.button:hover {
            background: #0056b3;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .success {
            padding: 10px;
            margin: 10px 0;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
        }
        .error {
            padding: 10px;
            margin: 10px 0;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Apply for a Program</h1>
        <p>Download the application form, fill it in, and upload it along with your supporting documents.</p>

        <a href="../assets/APPLICATION FORM -Research clinic courses.docx" download class="button">Download Application Form</a>

        <form action="apply.php" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" required>

            <label for="program">Desired Program:</label>
            <select name="program" id="program" required>
                <option value="">Select Program</option>
                <option value="Program 1">Data Analysis</option>
                <option value="Program 2">Programming</option>
                <option value="Program 3">Wede</option>
            </select>

            <label for="application_form">Upload Application Form:</label>
            <input type="file" name="application_form" id="application_form" accept=".pdf,.doc,.docx" required>

            <label for="supporting_docs">Upload Supporting Documents:</label>
            <input type="file" name="supporting_docs[]" id="supporting_docs" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" multiple>

            <button type="submit">Submit Application</button>
        </form>
    </div>
</body>
</html>


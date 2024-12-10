<?php
session_start();
include('../../db/DBConn.php'); 

 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/PHPMailer/src/PHPMailer.php';
require '../../vendor/PHPMailer/src/SMTP.php';
require '../../vendor/PHPMailer/src/Exception.php';

 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $status = isset($_POST['approve']) ? 'approved' : 'rejected';

 
    $sql = "UPDATE users SET status = '$status' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);

    if (mysqli_stmt_execute($stmt)) {
         
        $query = "SELECT email, username FROM users WHERE id = ?";
        $stmt_user = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt_user, 'i', $user_id);
        mysqli_stmt_execute($stmt_user);
        $result_user = mysqli_stmt_get_result($stmt_user);
        $user = mysqli_fetch_assoc($result_user);

        
        $subject = $status === 'approved' ? "Registration Approved" : "Registration Rejected";
        $message = $status === 'approved' 
            ? "Hello {$user['username']},\nYour registration has been approved. You can now log in." 
            : "Hello {$user['username']},\nYour registration has been rejected. Contact support for more information.";

        
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

            // Recipients
            $mail->setFrom('your-email@gmail.com', 'Research Clinic');
            $mail->addAddress($user['email'], $user['username']);  

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = nl2br($message);   

            
            $mail->send();
            echo 'Email sent successfully.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        
        header("Location: approve_student.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch pending registrations
$sql = "SELECT id, username, email, created_at FROM users WHERE status = 'pending'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Student Approvals</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/admin.css"> <!-- Adjust path for styling -->

    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        table tr:hover {
            background-color: #e9e9e9;
        }

        button {
            padding: 8px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:nth-child(1) {
            background-color: #28a745;
            color: white;
        }

        button[type="submit"]:nth-child(1):hover {
            background-color: #218838;
        }

        button[type="submit"]:nth-child(2) {
            background-color: #dc3545;
            color: white;
        }

        button[type="submit"]:nth-child(2):hover {
            background-color: #c82333;
        }

        form {
            display: inline-block;
            margin: 0 5px;
        }

        /* Add responsiveness */
        @media (max-width: 768px) {
            table th, table td {
                padding: 8px 10px;
            }

            h1 {
                font-size: 1.5rem;
            }

            button {
                font-size: 14px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>
    <h1>Pending Registrations</h1>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <form action="approve_student.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="approve">Approve</button>
                            </form>
                            <form action="approve_student.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pending registrations found.</p>
    <?php endif; ?>
</body>
</html>


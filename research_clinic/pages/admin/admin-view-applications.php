<?php
session_start();
include('../../db/DBConn.php');


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login/login.php');
    exit;
}

$username = $_SESSION['username']; 


$sql = "SELECT * FROM applications";
$result = mysqli_query($conn, $sql);


if (isset($_GET['approve_id'])) {
    $application_id = $_GET['approve_id'];


    $approve_sql = "UPDATE applications SET status = 'approved' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $approve_sql);
    mysqli_stmt_bind_param($stmt, 'i', $application_id);
    if (mysqli_stmt_execute($stmt)) {
      
        $applicant_sql = "SELECT name, email, program FROM applications WHERE id = ?";
        $applicant_stmt = mysqli_prepare($conn, $applicant_sql);
        mysqli_stmt_bind_param($applicant_stmt, 'i', $application_id);
        mysqli_stmt_execute($applicant_stmt);
        $applicant_result = mysqli_stmt_get_result($applicant_stmt);
        $applicant = mysqli_fetch_assoc($applicant_result);

 
        include('../../vendor/phpmailer/src/send_email.php');
       send_status_email($applicant['email'], $applicant['name'], $applicant['program'], 'accept');

        echo "<script>alert('Application approved and email sent.'); window.location.href = 'admin-view-applications.php';</script>";
    } else {
        echo "Error approving application.";
    }
}

if (isset($_GET['reject_id'])) {
    $application_id = $_GET['reject_id'];

    
    $reject_sql = "UPDATE applications SET status = 'rejected' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $reject_sql);
    mysqli_stmt_bind_param($stmt, 'i', $application_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Application rejected.'); window.location.href = 'admin-view-applications.php';</script>";
    } else {
        echo "Error rejecting application.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

     <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
	
	<style>

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
}

table thead tr {
    background-color: #f4f4f4;
    border-bottom: 2px solid #ddd;
}

table th, table td {
    padding: 12px 15px;
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

table th {
    color: #333;
    font-weight: bold;
    border-bottom: 2px solid #ddd;
}

table td a {
    color: #007bff;
    text-decoration: none;
}

table td a:hover {
    text-decoration: underline;
}

.container h1 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
}

.container p {
    font-size: 16px;
    margin-bottom: 20px;
    color: #666;
}

/* Centering the table in the container */
.container {
    max-width: 90%;
    margin: 0 auto;
}

	</style>
</head>
<body>
    <?php include('../../includes/header.php'); ?>
<section id="admin-dashboard">
    <div class="container">
        <h1>Welcome, Admin<?php echo htmlspecialchars($username); ?>!</h1>
        <p>Review the applications submitted by users.</p>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Files</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['program']); ?></td>
                            <td>
                                <?php 
                                    $files = json_decode($row['files'], true);
                                    foreach ($files as $file):
                                        $file_name = basename($file); // Get the file name without the path
                                ?>
                                    <a href="../../public/uploads/<?php echo htmlspecialchars($file_name); ?>" target="_blank">
                                        <?php echo htmlspecialchars($file_name); ?> (View)
                                    </a><br>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <?php if ($row['status'] !== 'approved' && $row['status'] !== 'rejected'): ?>
                                    <a href="admin-view-applications.php?approve_id=<?php echo $row['id']; ?>">Approve</a> | 
                                    <a href="admin-view-applications.php?reject_id=<?php echo $row['id']; ?>">Reject</a>
                                <?php else: ?>
                                    <?php echo ucfirst($row['status']); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No applications found.</p>
        <?php endif; ?>
    </div>
</section>


    <?php include('../../includes/footer.php'); ?>
</body>
</html>

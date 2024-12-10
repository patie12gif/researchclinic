<?php
session_start();
include('../db/DBConn.php');

 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login/login.php');  
    exit;
}
$sql = "SELECT * FROM contact_requests ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $sql);
$username = $_SESSION['username'];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <style>
        #admin-dashboard {
            padding: 20px;
            background: #f9f9f9;
        }
        .dashboard-options {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .dashboard-options .option {
            flex: 1 1 calc(25% - 20px);
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-options .option:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }
        .dashboard-options .option h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .dashboard-options .option a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .dashboard-options .option a:hover {
            color: #0056b3;
        }
        .notification {
            background: #ff9800;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
		
		#admin-contact-messages {
    padding: 2rem;
    background-color: #f9f9f9;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    font-size: 2rem;
    color: #333;
    margin-bottom: 1.5rem;
}

.message-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.message-table th, .message-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.message-table th {
    background-color: #007bff;
    color: white;
    font-size: 1.1rem;
}

.message-table tbody tr:nth-child(even) {
    background-color: #f4f4f4;
}

.message-table tbody tr:hover {
    background-color: #e0e0e0;
}

.message-table td a {
    text-decoration: none;
    padding: 8px 12px;
    margin: 5px;
    border-radius: 4px;
    font-weight: bold;
}

.btn-mark-read {
    background-color: #4CAF50;
    color: white;
}

.btn-mark-read:hover {
    background-color: #45a049;
}

.btn-delete {
    background-color: #f44336;
    color: white;
}

.btn-delete:hover {
    background-color: #d32f2f;
}

    </style>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <!-- Admin Dashboard -->
    <section id="admin-dashboard">
        <div class="container">
            <h1>Welcome, Admin <?php echo htmlspecialchars($username); ?>!</h1>
            <p>Manage all users, courses, and system settings.</p>

            <?php
            // Fetch pending user registrations for notifications
            $pending_sql = "SELECT COUNT(*) AS pending_count FROM users WHERE approved = 0";
            $pending_result = mysqli_query($conn, $pending_sql);
            $pending_count = $pending_result ? mysqli_fetch_assoc($pending_result)['pending_count'] : 0;
            ?>

            <?php if ($pending_count > 0): ?>
                <div class="notification">
                    You have <?php echo $pending_count; ?> pending user approval(s). <a href="admin-approve.php" style="color: #fff; text-decoration: underline;">Review now</a>
                </div>
            <?php endif; ?>

            <div class="dashboard-options">
                <div class="option">
                    <h3>Pending Approvals</h3>
                    <a href="../pages/admin/approve_student.php">Review Approvals</a>
                </div>
				<div class="option">
                    <h3>View Applications</h3>
                    <a href="../pages/admin/admin-view-applications.php">Review Applications</a>
                </div>
                <div class="option">
                    <h3>User Management</h3>
                    <a href="../pages/admin/admin-users.php">Manage Users</a>
                </div>
                <div class="option">
                    <h3>Course Management</h3>
                    <a href="../pages/admin/admin-courses.php">Manage Courses</a>
                </div>
                <div class="option">
                    <h3>Reports</h3>
                    <a href="../pages/admin/admin-reports.php">View Reports</a>
                </div>
                <div class="option">
                    <h3>System Settings</h3>
                    <a href="../pages/admin/admin-settings.php">Manage Settings</a>
                </div>
                <div class="option">
                    <h3>Activity Logs</h3>
                    <a href="../pages/admin/admin-logs.php">View Logs</a>
                </div>
            </div>
        </div>
    </section>
	
<section id="admin-contact-messages">
    <div class="container">
        <h1>Contact Messages</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="message-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                            <td>
                               <?php if ($row['status'] == 'unread'): ?>
                                    <a href="mark-as-read.php?id=<?php echo $row['id']; ?>" class="btn btn-mark-read">Mark as Read</a>
                                <?php else: ?>
                                    <span>Already Read</span>
                                <?php endif; ?>
                                <a href="delete-message.php?id=<?php echo $row['id']; ?>" class="btn btn-delete">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No messages found.</p>
        <?php endif; ?>
    </div>
</section>


    <?php include('../includes/footer.php'); ?>
</body>
</html>

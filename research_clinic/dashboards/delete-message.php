<?php
include('../db/DBConn.php');
if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    $sql = "DELETE FROM contact_requests WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $message_id);
    mysqli_stmt_execute($stmt);
    header('Location: admin-dashboard.php');
    exit();
}
?>

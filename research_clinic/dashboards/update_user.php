<?php
include '../db/DBConn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];


    $sql = "UPDATE users 
            SET username = ?, email = ?, role = ?, updated_at = NOW() 
            WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
       
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $role, $user_id);
     
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        header("Location: ../pages/admin/admin-users.php?message=User updated successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

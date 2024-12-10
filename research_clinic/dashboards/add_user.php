<?php
include '../db/DBConn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $passwordHash = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); 
    $role = trim($_POST['role']);
    $status = 'pending'; 

    $sql = "INSERT INTO users (username, email, password_hash, role, status, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
     
        mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $passwordHash, $role, $status);
        if (mysqli_stmt_execute($stmt)) {
      
            header("Location: ../pages/admin/admin-users.php?message=User added successfully");
            exit;
        } else {
            echo "Error executing query: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

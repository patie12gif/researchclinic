<?php
include('../../db/DBConn.php');  

 

$admin_username = 'Patience'; 
$admin_email = 'patiencedzanja44@gmail.com'; 
$admin_password = 'dzanja@12'; 


$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (username, email, password_hash, role, status)
        VALUES ('$admin_username', '$admin_email', '$hashed_password', 'admin', 'approved')";


if ($conn->query($sql) === TRUE) {
    echo "New admin user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>

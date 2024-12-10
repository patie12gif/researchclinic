<?php
session_start();
include('../db/DBConn.php'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT id, password_hash, role, status FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $username); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

          
            if ($user['status'] !== 'approved') {
                echo "Your account is not approved yet. Please wait for admin approval.";
            } else {
               
                if (password_verify($password, $user['password_hash'])) {
                   
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $user['role'];

                    
                    if ($user['role'] == 'student') {
                        header('Location: ../dashboards/student-dashboard.php');
                    } elseif ($user['role'] == 'instructor') {
                        header('Location: ../dashboards/instructor-dashboard.php');
                    } elseif ($user['role'] == 'admin') {
                        header('Location: ../dashboards/admin-dashboard.php');
                    }
                    exit;
                } else {
                    echo "Invalid credentials.";
                }
            }
        } else {
            echo "Invalid credentials.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
	<style>
	/* Styling the auth-container */
.auth-container {
    max-width: 400px;
    width: 100%;
    padding: 40px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin: auto;
    margin-top: 5%;
}

.auth-container h1 {
    font-size: 2rem;
    color: #007bff;
    margin-bottom: 30px;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    align-items: stretch;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

label {
    font-size: 1rem;
    color: #333;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
    box-sizing: border-box;
    margin-top: 5px;
}

input:focus {
    outline: none;
    border-color: #007bff;
}

button.btn {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.btn:hover {
    background-color: #0056b3;
}

/* Styling the "Don't have an account?" text */
p {
    font-size: 1rem;
    margin-top: 20px;
}

p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

p a:hover {
    text-decoration: underline;
}

/* Responsive design */
@media (max-width: 768px) {
    .auth-container {
        padding: 30px;
        margin-top: 10%;
    }

    .auth-container h1 {
        font-size: 1.8rem;
    }

    button.btn {
        padding: 14px;
        font-size: 1rem;
    }
}

	</style>
</head>
<body>
    <div class="auth-container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>
</html>



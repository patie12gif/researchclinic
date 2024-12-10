<?php
include '../../db/DBConn.php';

$sql = "SELECT id, username, email, role, created_at, updated_at FROM users";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
	  <script src="../pages/admin/admin.js"></script>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    <h1 style="text-align: center; color: #007bff;">Manage Users</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #007bff; color: white;">
                    <th style="padding: 8px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Username</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Email</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Role</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Created At</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Updated At</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo $row['id']; ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['username']); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['role']); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['updated_at']); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            <button 
    style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;" 
    onclick="openUpdateModal('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['role'], ENT_QUOTES); ?>')">
    Update
</button>


                            <form action="/research_clinic/dashboards/delete_user.php" method="POST" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
		<button onclick="openAddUserModal()" style="padding: 5px 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 20px;">Add User</button>

    <?php else: ?>
        <p style="color: #dc3545; text-align: center;">No users found.</p>
    <?php endif; ?>
    
	<div id="addUserModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 8px; width: 400px;">
        <h2 style="margin-top: 0; color: #28a745;">Add User</h2>
        <form action="../../dashboards/add_user.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>
            <label for="email">Email:</label>
            <input type="email" name="email" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>
            <label for="password">Password:</label>
            <input type="password" name="password" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>
            <label for="role">Role:</label>
            <select name="role" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Add</button>
            <button type="button" onclick="closeAddUserModal()" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
        </form>
    </div>
</div>

    <script>
	function openUpdateModal(id, username, email, role) {
    console.log("Opening modal with:", id, username, email, role);

    // Create the modal
    const modalHtml = `
        <div id="updateUserModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
            <div style="background: white; padding: 20px; border-radius: 8px; width: 400px;">
                <h2 style="margin-top: 0; color: #007bff;">Update User</h2>
               <form action="../../dashboards/update_user.php" method="POST">

                    <input type="hidden" name="user_id" value="${id}">
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="${username}" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="${email}" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>
                    <label for="role">Role:</label>
                    <select name="role" style="width: 100%; padding: 8px; margin-bottom: 10px;">
                        <option value="student" ${role === 'student' ? 'selected' : ''}>Student</option>
                        <option value="instructor" ${role === 'instructor' ? 'selected' : ''}>Instructor</option>
                        <option value="admin" ${role === 'admin' ? 'selected' : ''}>Admin</option>
                    </select>
                    <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                    <button type="button" onclick="closeModal()" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
                </form>
            </div>
        </div>
    `;

    // Append modal to the body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function closeModal() {
    const modal = document.getElementById('updateUserModal');
    if (modal) modal.remove();
}

function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'flex';
}

function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}


	</script>
</body>
</html>

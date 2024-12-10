function openUpdateModal(id, username, email, role) {
    console.log("Opening modal with:", id, username, email, role);


    const modalHtml = `
        <div id="updateUserModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
            <div style="background: white; padding: 20px; border-radius: 8px; width: 400px;">
                <h2 style="margin-top: 0; color: #007bff;">Update User</h2>
                <form action="update_user.php" method="POST">
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

 
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function closeModal() {
    const modal = document.getElementById('updateUserModal');
    if (modal) modal.remove();
}

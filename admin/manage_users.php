<?php
require_once(realpath(dirname(__FILE__) . '/../init.php'));

// Fetch all users
$result = $conn->query("SELECT user_id, email, role, created_at FROM users");

// Handle form submission for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // Default role to 'user'

    if (!empty($email) && !empty($password) && in_array($role, ['user', 'author', 'admin'])) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $success_message = "User created successfully!";
        } else {
            $error_message = "Error creating user: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_message = "All fields are required, and role must be valid.";
    }
}

// Fetch updated users after a new one is added
$result = $conn->query("SELECT user_id, email, role, created_at FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../static/css/manage_users.css">
</head>
<body>
    <h2>Manage Users</h2>

    <!-- Success/Error Messages -->
    <?php if (isset($success_message)): ?>
        <div class="message success"><?= htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="message error"><?= htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Add New User Form -->
    <div class="user-form">
        <h3>Create New User</h3>
        <form id="createUserForm">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="author">Author</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Create User</button>
        </form>
        <div id="formMessage" class="message hidden"></div>
    </div>

    <!-- Display Existing Users -->
    <div class="user-table">
        <h3>Existing Users</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['user_id']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['role']); ?></td>
                        <td><?= htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $row['user_id']; ?>">Edit</a>
                            <a href="delete_user.php?id=<?= $row['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

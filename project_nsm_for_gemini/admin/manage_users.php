<?php
require_once('../config.php');

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Optionally, set a flash message about unauthorized access
    header('Location: ../index.php');
    exit;
}
?>
<?php
require_once(realpath(dirname(__FILE__) . '/../init.php'));
require_once('../admin/admin_includes/admin_heading.php');

// Fetch all users
$result = $conn->query("SELECT user_id, username, email, role, created_at FROM users");

// Handle form submission for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // Default role to 'user'

    if (!empty($email) && !empty($password) && in_array($role, ['user', 'author', 'admin'])) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

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
$result = $conn->query("SELECT user_id, username, email, role, created_at FROM users");
?>

    <h2>Manage Users</h2>
    <!-- Add New User Form -->
    <div class="user-form">
        <h3>Create New User</h3>
        <form id="createUserForm" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" require>

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
    <div class="user-table-div">
        <h3>Existing Users</h3>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
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
                        <td class="username"><?= htmlspecialchars($row['username']); ?></td>
                        <td class="user-email"><?= htmlspecialchars($row['email']); ?></td>
                        <td class="user-role"><?= htmlspecialchars($row['role']); ?></td>
                        <td><?= htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <!-- Form for deletion -->
                            <form method="POST" action="../admin/admin_includes/users_actions/delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($row['user_id']); ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

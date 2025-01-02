<?php
require_once(realpath(dirname(__FILE__) . '/../init.php'));

// Fetch all users
$result = $conn->query("SELECT user_id, email, role, created_at FROM users");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['user_id']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['role']) . "</td>
                <td>" . htmlspecialchars($row['created_at']) . "</td>
                <td>
                    <a href='edit_user.php?id=" . $row['user_id'] . "'>Edit</a>
                    <a href='delete_user.php?id=" . $row['user_id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found.</td></tr>";
}
?>

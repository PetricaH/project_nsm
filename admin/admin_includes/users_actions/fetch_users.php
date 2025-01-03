<?php
require_once(realpath(dirname(__FILE__) . '/../../init.php'));
header('Content-Type: text/html');

// Fetch all users
$result = $conn->query("SELECT user_id, email, role, created_at FROM users");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['user_id']) . "</td>
                <td class='user-email'>" . htmlspecialchars($row['email']) . "</td>
                <td class='user-role'>" . htmlspecialchars($row['role']) . "</td>
                <td>" . htmlspecialchars($row['created_at']) . "</td>
                <td>
                    <button class='delete-user' data-user-id='" . $row['user_id'] . "'>Delete</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found.</td></tr>";
}
?>

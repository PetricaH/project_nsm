<h2 id="manage_bookings_h2">Manage Bookings</h2>

<div id="bookings_container">
    <table id="bookings_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Service</th>
                <th>Description</th>
                <th>Submission Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('../config.php');

            // Fetch bookings from the database
            $query = "SELECT * FROM bookings ORDER BY id DESC";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-id='" . $row['id'] . "'>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['service']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>
                        <select class='status-select' data-id='" . $row['id'] . "'>
                            <option value='Pending' " . ($row['status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                            <option value='Approved' " . ($row['status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                            <option value='Completed' " . ($row['status'] === 'Completed' ? 'selected' : '') . ">Completed</option>
                            <option value='Canceled' " . ($row['status'] === 'Canceled' ? 'selected' : '') . ">Canceled</option>
                        </select>
                    </td>";
                    echo "<td>
                        <button class='delete-btn' data-id='" . $row['id'] . "'>Delete</button>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No bookings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div id="notification" class="notification hidden">
    <span class="close" onclick="closeNotification()">X</span>
    <span id="notificationMessage"></span>
</div>
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
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['service']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No bookings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div id="notification" class="notification hidden">
    <span class="close" onclick="closeNotification()">X</span>
    <span id="notificationMessage"></span>
</div>

<script>
function closeNotification() {
    document.getElementById('notification').classList.add('hidden');
}
</script>
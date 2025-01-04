<?php
require_once('../admin/admin_includes/admin_heading.php');
// Fetch bookings data
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<h1>Manage Bookings</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Service</th>
            <th>Description</th>
            <th>Privacy Policy</th>
            <th>Booking Date & Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr data-id="<?php echo $row['id']; ?>">
            <td><?php echo $row['id']; ?></td>
            <td contenteditable="true" class="editable" data-column="name"><?php echo $row['name']; ?></td>
            <td contenteditable="true" class="editable" data-column="email"><?php echo $row['email']; ?></td>
            <td contenteditable="true" class="editable" data-column="service"><?php echo $row['service']; ?></td>
            <td contenteditable="true" class="editable" data-column="description"><?php echo $row['description']; ?></td>
            <td>
                <input type="checkbox" class="editable" data-column="privacy_policy" <?php echo $row['privacy_policy'] ? 'checked' : ''; ?>>
            </td>
            <td contenteditable="true" class="editable" data-column="booking_datetime"><?php echo $row['booking_datetime']; ?></td>
            <td>
                <select class="editable" data-column="status">
                    <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Approved" <?php echo $row['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                    <option value="Rejected" <?php echo $row['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </td>
            <td>
                <button class="delete-btn">Delete</button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php include ('../admin/admin_includes/admin_footer.php'); ?>
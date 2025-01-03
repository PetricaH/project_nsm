<!DOCTYPE html>
<html>
<head>
    <title>Debugging Manage Bookings</title>
</head>
<body>
    <h1>Manage Bookings</h1>

    <!-- Add a simple table to simulate some content -->
    <table id="bookings_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>
                    <select name="status">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Completed">Completed</option>
                    </select>
                </td>
                <td><button id="saveButton">Save</button></td>
            </tr>
        </tbody>
    </table>

    <!-- JavaScript for Debugging -->
    <script>
        console.log("JavaScript loaded in manage_bookings.php");

        // Debugging button click
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('saveButton');
            if (button) {
                button.addEventListener('click', () => {
                    console.log('Save button clicked!');
                });
            } else {
                console.error('Save button not found!');
            }
        });
    </script>
</body>
</html>

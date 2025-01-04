$(document).ready(function () {
     // Inline editing for dropdown
     $(document).on("change", "select.editable", function () {
        var row = $(this).closest("tr");
        var id = row.data("id");
        var column = $(this).data("column");
        var value = $(this).val(); // Get the selected value

        // AJAX to update the status
        $.ajax({
            url: "../admin/admin_includes/booking_actions/update_booking_status.php", // Correct path
            method: "POST",
            data: { id: id, column: column, value: value },
            success: function (response) {
                if (response.trim() === "success") { // Handle success case
                    console.log("Status updated successfully.");
                } else {
                    alert("Failed to update status.");
                }
            },
            error: function () {
                alert("Error connecting to the server.");
            }
        });
    });

    // Attach delete button event
    $(document).on("click", ".delete-btn", function() {
        var row = $(this).closest("tr");
        var id = row.data("id");

        if (confirm("Are you sure you want to delete this booking?")) {
            $.ajax({
                url: "../admin/admin_includes/booking_actions/delete_booking.php",
                method: "POST",
                data: { id: id},
                success: function(response) {
                    if (response.trim() === "success") { // check for success
                        // Add fade-out effect before removing the row
                        row.fadeOut(500, function () {
                            $(this).remove(); // Remove row after fade-out
                        });
                        console.log("Booking deleted successfully!");
                    } else {
                        alert("Failed to delete booking.");
                    }
                },
                error: function() {
                    alert("Error connecting to the server.");
                }
            });
        }
    });
});

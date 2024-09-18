<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .notification-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .notification-item p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notifications</h1>
        <div id="notificationContainer"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchNotifications() {
                $.ajax({
                    type: "GET",
                    url: "fetchs_notifications.php",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            $("#notificationContainer").empty();
                            if (response.notifications.length > 0) {
                                response.notifications.forEach(function(notification) {
                                    var notificationHtml = `
                                        <div class="notification-item">
                                            <p><strong>Customer ID:</strong> ${notification.customer_id}</p>
                                            <p><strong>Name:</strong> ${notification.firstname}</p>
                                            <p><strong>Created At:</strong> ${notification.created_at}</p>
                                            <p><strong>Message:</strong> ${notification.message}</p> <!-- Display the message -->
                                        </div>
                                    `;
                                    $("#notificationContainer").append(notificationHtml);
                                });
                            } else {
                                $("#notificationContainer").html("<p>No notifications found.</p>");
                            }
                        } else {
                            alert("Error fetching notifications: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        console.error("Status:", status);
                        console.error("Response:", xhr.responseText);
                        alert("An unexpected error occurred while fetching notifications. Please try again later.");
                    }
                });
            }

            fetchNotifications();
            setInterval(fetchNotifications, 30000); // Fetch notifications every 30 seconds
        });
    </script>
</body>
</html>

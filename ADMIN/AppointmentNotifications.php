<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Notification Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Overall body styling */
        body {
            background-color: #f4f7fa;
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Back Button Styling */
        .btn-back {
            background-color: #6c757d;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #495057;
        }

        /* Grid layout for notifications */
        #notificationContainer {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        /* Card design for notifications */
        .notification-item {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            cursor: pointer;
        }

        /* Hover effect for notification cards */
        .notification-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Title and text inside notification card */
        .notification-item h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 15px;
            color: #007bff;
        }

        .notification-item p {
            font-size: 14px;
            color: #444;
            margin-bottom: 10px;
        }

        /* View Details button */
        .btn-view {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn-view:hover {
            background-color: #0056b3;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            padding: 25px 30px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .modal-body {
            padding: 25px;
            background-color: #f9f9f9;
        }

        /* Modal Content */
        #modalNotificationContent p {
            font-size: 16px;
            color: #444;
            margin-bottom: 15px;
        }

        .modal-footer {
            border-top: none;
            padding: 20px;
            background-color: #f4f7fa;
        }

        #btnTakeAppointment {
            background-color: #28a745;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        #btnTakeAppointment:hover {
            background-color: #218838;
        }

        /* Clear Notification Button */
        #btnClearNotification {
            background-color: #dc3545;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        #btnClearNotification:hover {
            background-color: #c82333;
        }

        /* Modal Animation */
        .modal.fade .modal-dialog {
            transform: translateY(-50px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
            opacity: 1;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Notifications</h1>

        <!-- Back Button -->
        <a href="Dashboard.php" class="btn-back mb-4">Back to Dashboard</a>

        <!-- Notifications Container -->
        <div id="notificationContainer"></div>
    </div>

    <!-- Modal for Viewing Notification Details -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalNotificationContent"></div>
                    <button class="btn btn-block" id="btnTakeAppointment">Take Appointment</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-block" id="btnClearNotification">Clear Permanently</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentCustomerId = null;

            // Fetch notifications from the server
            function fetchNotifications() {
                $.ajax({
                    type: "GET",
                    url: "fetchs_notifications.php",
                    dataType: "json",
                    success: function(response) {
                        $("#notificationContainer").empty();
                        if (response.status === 'success' && response.notifications.length > 0) {
                            response.notifications.forEach(function(notification) {
                                var notificationHtml = `
                                    <div class="notification-item" data-id="${notification.customer_id}">
                                        <h5>Notification for Customer: ${notification.firstname}</h5>
                                        <p><strong>Message:</strong> ${notification.message}</p>
                                        <p><strong>Created At:</strong> ${notification.created_at}</p>
                                        <a href="#" class="btn-view" data-id="${notification.customer_id}" data-message="${notification.message}">View Details</a>
                                    </div>
                                `;
                                $("#notificationContainer").append(notificationHtml);
                            });
                        } else {
                            $("#notificationContainer").html("<p>No notifications found.</p>");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        alert("An unexpected error occurred while fetching notifications. Please try again later.");
                    }
                });
            }

            // Open modal with notification details
            $(document).on('click', '.btn-view', function(event) {
                event.preventDefault();
                currentCustomerId = $(this).data('id');
                var message = $(this).data('message');
                var notificationContent = `
                    <p><strong>Customer ID:</strong> ${currentCustomerId}</p>
                    <p><strong>Message:</strong> ${message}</p>
                `;
                $("#modalNotificationContent").html(notificationContent);
                $('#notificationModal').modal('show');
            });

            // Take appointment and hide notification
            $('#btnTakeAppointment').on('click', function() {
                if (currentCustomerId) {
                    $(`.notification-item[data-id="${currentCustomerId}"]`).hide();
                    $('#notificationModal').modal('hide');

                    setTimeout(function() {
                        if ($("#notificationContainer").children(':visible').length === 0) {
                            window.location.href = 'Dashboard.php';
                        }
                    }, 500);
                } else {
                    alert("No appointment to take!");
                }
            });

            // Clear notification permanently
            $('#btnClearNotification').on('click', function() {
                if (currentCustomerId) {
                    $.ajax({
                        type: "POST",
                        url: "clear_notification.php",
                        data: { customer_id: currentCustomerId },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert("Notification cleared successfully.");
                                $(`.notification-item[data-id="${currentCustomerId}"]`).remove();
                                $('#notificationModal').modal('hide');
                            } else {
                                alert("Failed to clear notification.");
                            }
                        }
                    });
                }
            });

            // Initialize notifications
            fetchNotifications();
        });
    </script>

</body>
</html>

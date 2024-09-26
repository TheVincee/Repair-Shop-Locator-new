<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Notification Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Grid layout */
        #notificationContainer {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        /* Card styling */
        .notification-item {
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect for 3D feel */
        .notification-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Styling for the text inside the card */
        .notification-item p {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }

        .notification-item .btn-view {
            display: block;
            text-align: center;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .notification-item .btn-view:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            padding: 20px;
        }

        .modal-title {
            margin: 0;
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 30px;
            background-color: #f8f9fa;
        }

        #modalNotificationContent p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .modal-footer {
            border-top: none;
            padding: 20px;
            background-color: #f8f9fa;
        }

        /* Button inside modal */
        #btnTakeAppointment {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        #btnTakeAppointment:hover {
            background-color: #218838;
            cursor: pointer;
        }

        /* Animation for the modal */
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
        <h1 class="mt-4">Notifications</h1>
        
        <!-- Back Button -->
        <a href="Dashboard.php" class="btn btn-secondary mb-3">Back</a>

        <div id="notificationContainer"></div>
    </div>

    <!-- Modern Modal for Viewing Notification Details -->
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
                    <button type="button" class="btn btn-danger" id="btnClearNotification">Clear Permanently</button>
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
                                        <p><strong>Customer ID:</strong> ${notification.customer_id}</p>
                                        <p><strong>Name:</strong> ${notification.firstname}</p>
                                        <p><strong>Created At:</strong> ${notification.created_at}</p>
                                        <p><strong>Message:</strong> ${notification.message}</p>
                                        <a href="#" class="btn btn-view" data-id="${notification.customer_id}" data-message="${notification.message}">View Details</a>
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
                        dataType: "json",
                        success: function(response) {
                            if (response.status === 'success') {
                                $(`.notification-item[data-id="${currentCustomerId}"]`).remove(); // Remove notification from UI
                                $('#notificationModal').modal('hide'); // Close the modal
                                
                                // Check if there are no visible notifications left
                                if ($("#notificationContainer").children(':visible').length === 0) {
                                    $("#notificationContainer").html("<p>No notifications found.</p>"); // Show empty state
                                }
                            } else {
                                alert("Error: " + response.message); // Handle error
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                            alert("An unexpected error occurred while clearing the notification. Please try again later.");
                        }
                    });
                }
            });

            // Initially fetch notifications
            fetchNotifications();
            setInterval(fetchNotifications, 30000); 
        });
    </script>
</body>
</html>

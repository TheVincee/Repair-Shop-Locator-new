<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9; /* Soft background color */
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: white; /* White background for the container */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff; /* Primary color for headings */
        }
        .notification-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }
        .notification {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff; /* Notification card color */
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effects */
            position: relative; /* Positioning context for the shadow effect */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .notification:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
        }
        .notification-message {
            font-size: 16px; /* Increased font size for readability */
            margin: 0;
        }
        .btn-mark-read {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            width: 100%; /* Full width for button */
            margin-top: 20px;
        }
        .btn-mark-read:hover {
            background-color: #218838; /* Darker green on hover */
        }
        .no-notifications {
            text-align: center;
            font-style: italic;
            color: #999; /* Light gray for no notifications message */
        }
        .alert {
            display: none; /* Initially hidden */
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Notifications</h2>
    <div id="notification-status" class="notification-grid">
        Loading notifications...
    </div>
    <button class="btn btn-mark-read" id="markAsReadBtn">
        Mark All as Read
    </button>
    <button class="btn btn-secondary" id="backBtn">
        Back
    </button>
    <div id="statusMessage" class="alert alert-success" role="alert"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const notificationStatusElement = document.getElementById('notification-status');
    const markAsReadBtn = document.getElementById('markAsReadBtn');
    const statusMessageElement = document.getElementById('statusMessage');
    const backBtn = document.getElementById('backBtn');

    function loadNotifications() {
        fetch('fetch_notifications.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.notifications.length > 0) {
                        let statusHtml = '';
                        data.notifications.forEach(notification => {
                            statusHtml += `
                                <div class="notification" data-id="${notification.id}" onclick="redirectToAppointment(${notification.id})">
                                    <span class="notification-message">${notification.message}</span>
                                </div>
                            `;
                        });
                        notificationStatusElement.innerHTML = statusHtml.trim();
                    } else {
                        notificationStatusElement.innerHTML = '<div class="no-notifications">No notifications found</div>';
                    }
                } else {
                    notificationStatusElement.innerHTML = '<div class="no-notifications">Error fetching notifications: ' + data.error + '</div>';
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                notificationStatusElement.innerHTML = '<div class="no-notifications">Error fetching notifications</div>';
            });
    }

    function markAllNotificationsAsRead() {
        fetch('mark_notifications_as_read.php', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications(); // Refresh notifications after marking as read
                showSuccessMessage('All notifications have been marked as read.');
            } else {
                console.error('Error marking notifications as read:', data.error);
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error marking notifications as read:', error);
            alert('An error occurred: ' + error.message);
        });
    }

    function showSuccessMessage(message) {
        statusMessageElement.innerText = message;
        statusMessageElement.style.display = 'block'; // Show the message
        setTimeout(() => {
            statusMessageElement.style.display = 'none'; // Hide after a few seconds
        }, 3000);
    }

    window.redirectToAppointment = function(notificationId) {
        window.location.href = 'Appointment-table.php?id=' + notificationId;
    };

    backBtn.addEventListener('click', function() {
        window.history.back(); // Go back to the previous page
    });

    loadNotifications();

    markAsReadBtn.addEventListener('click', function() {
        markAllNotificationsAsRead();
    });
});
</script>

</body>
</html>

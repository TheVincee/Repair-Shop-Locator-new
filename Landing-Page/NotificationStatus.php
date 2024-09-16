<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notifications</title>
    <!-- Add Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .modal-body {
            padding: 20px;
        }
        .notification {
            margin-bottom: 10px;
        }
        .notification-message {
            display: inline-block;
            margin-right: 10px;
        }
        .btn-mark-read {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal">
        View Notifications
    </button>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel"><i class="fas fa-info-circle"></i> Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Display Notifications -->
                <div id="notification-status">
                    Loading...
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-mark-read" id="markAsReadBtn">
                    Mark as Read
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS for modal functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusModal = document.getElementById('statusModal');
    const notificationStatusElement = document.getElementById('notification-status');
    const markAsReadBtn = document.getElementById('markAsReadBtn');
    let notificationIdToMarkRead = null;

    function loadNotifications() {
        // AJAX request to fetch notifications
        fetch('fetch_notifications.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.notifications.length > 0) {
                        let statusHtml = '';
                        data.notifications.forEach(notification => {
                            statusHtml += `
                                <div class="notification" data-id="${notification.id}">
                                    <span class="notification-message"> ${notification.message}</span>
                                    <button class="btn btn-mark-read" onclick="setNotificationId(${notification.id})">
                                        Mark as Read
                                    </button>
                                </div>
                            `;
                        });

                        // Set the status HTML
                        notificationStatusElement.innerHTML = statusHtml.trim() || 'No notifications found';
                    } else {
                        notificationStatusElement.innerHTML = 'No notifications found';
                    }
                } else {
                    notificationStatusElement.innerHTML = 'Error fetching notifications: ' + data.error;
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                notificationStatusElement.innerHTML = 'Error fetching notifications';
            });
    }

    function setNotificationId(id) {
        notificationIdToMarkRead = id;
    }

    function markNotificationAsRead() {
        if (notificationIdToMarkRead) {
            fetch('mark_notifications_as_read.php?id=' + notificationIdToMarkRead, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload notifications after deletion
                    loadNotifications();
                } else {
                    console.error('Error deleting notification:', data.error);
                }
            })
            .catch(error => {
                console.error('Error deleting notification:', error);
            });
        }
    }

    statusModal.addEventListener('show.bs.modal', function () {
        loadNotifications();
    });

    markAsReadBtn.addEventListener('click', function() {
        markNotificationAsRead();
    });
});
</script>

</body>
</html>

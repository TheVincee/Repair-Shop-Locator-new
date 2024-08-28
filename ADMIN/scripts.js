document.addEventListener('DOMContentLoaded', function() {
    // Ensure elements are present before adding event listeners
    const fetchAppointmentsBtn = document.getElementById('fetch-appointments');
    if (fetchAppointmentsBtn) {
        fetchAppointmentsBtn.addEventListener('click', function() {
            // Create a new XMLHttpRequest object
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_pending_appointments.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            // Handle the response
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const response = JSON.parse(xhr.responseText);
                    const appointmentsList = document.getElementById('appointments-list');
                    if (appointmentsList) {
                        appointmentsList.innerHTML = '';
                        if (response.error) {
                            alert(response.error);
                        } else {
                            response.forEach(function(appointment) {
                                const div = document.createElement('div');
                                div.innerHTML = `
                                    <p><strong>Customer ID:</strong> ${appointment.customer_id}</p>
                                    <p><strong>First Name:</strong> ${appointment.firstname}</p>
                                    <p><strong>Repair Details:</strong> ${appointment.repairdetails}</p>
                                    <hr>
                                `;
                                appointmentsList.appendChild(div);
                            });
                        }
                    } else {
                        alert('Appointments list container not found.');
                    }
                } else {
                    alert('An error occurred while fetching data.');
                }
            };

            xhr.onerror = function() {
                alert('Request failed.');
            };

            xhr.send();
        });
    } else {
        console.error('Fetch appointments button not found.');
    }
});
